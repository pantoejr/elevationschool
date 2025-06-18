<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PaymentHelper;
use App\Models\Section;
use App\Models\StudentSection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Payment;
use App\Models\SectionInstallment;
use App\Models\StudentInvoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Throw_;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

        $payments = Payment::all();
        return view('payments.index', [
            'title' => 'Payments',
            'payments' => $payments
        ]);
    }

    public function create()
    {
        $sections = Section::all();
        return view('payments.create', [
            'title' => 'Payments',
            'sections' => $sections
        ]);
    }

    public function getStudent(Request $request)
    {

        $request->validate([
            'section_id' => 'required|exists:sections,id',
        ]);

        $students = StudentSection::where('section_id', '=', $request->section_id)
            ->with('Student')->get();

        return view('payments.studentlist', [
            'title' => '',
            'students' => $students
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'student_id' => 'required|exists:students,id',
            'currency' => 'required|string|in:usd,lrd',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|min:0.01|max:1000000',
            'reference' => 'nullable|string|max:1000',
            'attachment' => 'nullable|file|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Handle attachment upload
            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $attachmentPath = $attachment->storeAs(
                    'payments/attachment',
                    time() . '_' . $attachment->getClientOriginalName(),
                    'public'
                );
            }

            // Fetch the student's section
            $studentSection = StudentSection::where('student_id', $request->student_id)
                ->where('section_id', $request->section_id)
                ->firstOrFail();

            // Fetch the section and its cost
            $section = Section::findOrFail($request->section_id);
            $cost = $section->course_cost;

            // Fetch or create the student's invoice
            $studentInvoice = StudentInvoice::where('student_section_id', $studentSection->id)->first();
            if (!$studentInvoice) {
                $studentInvoice = StudentInvoice::create([
                    'student_section_id' => $studentSection->id,
                    'invoice_id' => (string) $this->generateRandomNumericString(),
                    'amount_paid' => 0,
                    'balance' => $cost,
                    'due_date' => $section->end_date,
                    'currency' => $request->currency,
                    'is_completed' => false,
                    'created_by' => Auth::user()->name,
                    'updated_by' => Auth::user()->name,
                ]);
            }

            // Get all installments for the section, in order
            $sectionInstallments = SectionInstallment::where('section_id', $request->section_id)
                ->with('installment')
                ->orderBy('id')
                ->get();

            if ($sectionInstallments->isEmpty()) {
                throw new Exception('No installments found for this section.');
            }

            // Calculate how much has already been paid for this invoice
            $alreadyPaid = $studentInvoice->amount_paid;
            $remainingPayment = floatval($request->amount);
            $totalPaid = $alreadyPaid;

            foreach ($sectionInstallments as $sectionInstallment) {
                if ($remainingPayment <= 0) break;

                $installmentName = $sectionInstallment->installment->name ?? 'Installment';
                $installmentAmount = $sectionInstallment->amount;

                // Calculate how much has already been paid towards this installment
                $paidForThisInstallment = Payment::where('student_invoice_id', $studentInvoice->invoice_id)
                    ->where('notes', 'like', "{$installmentName}%")
                    ->sum('amount_paid');

                $installmentRemaining = $installmentAmount - $paidForThisInstallment;

                if ($installmentRemaining <= 0) {
                    continue; // This installment is already fully paid
                }

                $payingNow = min($remainingPayment, $installmentRemaining);

                $status = ($payingNow == $installmentRemaining) ? 'Completed' : 'Partial';

                Payment::create([
                    'student_invoice_id' => $studentInvoice->invoice_id,
                    'amount_paid' => $payingNow,
                    'payment_date' => now(),
                    'currency' => strtolower($request->currency),
                    'payment_method' => $request->payment_method,
                    'payment_reference' => $this->generateRandomNumericString(8),
                    'status' => 'pending',
                    'notes' => "{$installmentName} - {$status}",
                    'attachment' => $attachmentPath,
                    'created_by' => Auth::user()->name,
                    'updated_by' => Auth::user()->name,
                ]);

                $remainingPayment -= $payingNow;
                $totalPaid += $payingNow;
            }

            // Update the student's invoice
            $studentInvoice->update([
                'amount_paid' => $totalPaid,
                'balance' => $cost - $totalPaid,
                'is_completed' => ($cost - $totalPaid) <= 0,
                'updated_by' => Auth::user()->name,
            ]);

            DB::commit();

            return redirect()->route('payments.index')
                ->with('success', 'Payment(s) inserted successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            DB::rollBack();
            return back()
                ->with('success', 'Error: ' . $ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function show(Payment $payment)
    {
        return view('payments.show', [
            'title' => 'Payment Details',
            'payment' => $payment,
        ]);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')
            ->with('success', 'Payment inserted successfully')
            ->with('flag', 'success');
    }

    public function previewPdf(Payment $payment)
    {
        $pdf = Pdf::loadView('payments.pdf', ['payment' => $payment]);
        return $pdf->stream('_receipt_' . $payment->studentInvoice->invoice_id . '_' . now()->format('Ymd') . '.pdf');
    }

    public function downloadPdf(Payment $payment)
    {
        $pdf = Pdf::loadView('payments.pdf', ['payment' => $payment]);
        return $pdf->download('receipt_' . $payment->studentInvoice->invoice_id . '_' . now()->format('Ymd') . '.pdf');
    }

    function generateRandomNumericString($length = 6)
    {

        $digits = '';
        for ($i = 0; $i < $length; $i++) {
            $digits .= random_int(0, 9);
        }
        return $digits;
    }
}
