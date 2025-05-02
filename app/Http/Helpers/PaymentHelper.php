<?php   

namespace App\Http\Helpers;

use App\Models\Installment;
use App\Models\Payment;
use App\Models\SectionInstallment;
use App\Models\StudentSection;
use App\Models\StudentInvoice;
use App\Models\Section;


class PaymentHelper 
{

    public function makePayment(int $student_id, int $section_id, float $amount, string $method) 
    {

        try {

            $installment = Installment::all()->orderBy('id', 'desc');

            $studentSection = StudentSection::where('student_id', '=', $student_id);
            $studentInvoice = StudentInvoice::findOrFail($studentSection->id);
            $section = Section::findOrFail($section_id);

            $installment = $section->sectionInstallments()->where('section_id', $section_id)->first();

            $cost = $section->course_cost;

            $total_pay = $amount + $studentInvoice->amount_paid;
            $balance = $cost - $total_pay;

            $note = "";
            $in_cost = 0;
            foreach ($installment as $value) {
                # code...
                $sectionInstallment = SectionInstallment::where('installment_id', '=', $value->id)->first();
                if ($sectionInstallment == null) {
                    break;
                }
 
                $installmentAmount = $sectionInstallment->amount;
                $in_cost = $in_cost + $installmentAmount;
                if ($total_pay >= $in_cost) {
                    # code...
                    $note = "{$note} {$value->name} - Completed;";
                    if ($in_cost == $total_pay) {
                        break;
                    }
                } else {
                    $note = "{$note} {$value->name} - Partial;";
                    break;
                }
            }

            Payment::create([
               'student_invoice_id' => $studentSection->id,
                'amount_paid' => $amount,
                'currency' => 'USD',
                'payment_method' => $method,
                'note'=> $note,
                'status' => 'pending',
                'payment_reference' => '123456789',
                'attachment' => 'attachment.png',
            ]);
            $studentInvoice->update([
                'amount_paid' => $total_pay,
                'balance' => $balance,
                'is_completed' => ($balance <= 0) ? 1 : 0,
            ]);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }


}