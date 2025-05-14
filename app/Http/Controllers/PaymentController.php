<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PaymentHelper;
use App\Models\Section;
use App\Models\StudentSection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\Auth;


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
            'currency' => 'required|string',
            'payment_method' => 'required|string',
            'amount' => 'nullable|string|max:1000',
            'reference' => 'nullable|string|max:1000',
            'attachment' => 'nullable',
        ]);

        try {

            $paymentHelper = new PaymentHelper();
            $paymentHelper->makePayment(
                $request->student_id,
                $request->section_id,
                $request->amount,
                $request->payment_method,
                Auth::user()->name,
                $request->currency
            );

            return redirect()->route('payments.index')
                ->with('success', 'Payment inserted successfully')
                ->with('flag', 'success');

        } catch (Exception $ex) {
            return back()
                ->with('success', 'Error: ' . $ex->getMessage())
                ->with('flag', 'error');
        }
    }
}
