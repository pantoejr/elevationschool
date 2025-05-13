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


    public function makePayment(int $student_id, int $section_id, float $amount, string $method, string $user, string $currency) 
    {

        try {

            $installments = Installment::all();
            
            $studentSection = StudentSection::where(
                'student_id', '=', $student_id)
                ->where('section_id', '=', $section_id)
                ->first();

            $section = Section::findOrFail($section_id);

            $cost = $section->course_cost;

            $studentInvoice = StudentInvoice::where(
                'student_section_id', '=', $studentSection->id)
                ->first();

            if ($studentInvoice == null) {
                dd('ho');
                $studentInvoice = StudentInvoice::create(
                    [
                        'invoice_id'=> 1234,
                        'student_section_id'=> $studentSection->id,
                        'amount_paid'=> 0,
                        'balance'=> $section->course_cost,
                        'due_date'=> $section->end_date,
                        'is_completed'=> false,
                        'currency'=> $currency,
                        'created_by'=> $user,
                        'updated_by' => $user,
                    ]
                );
            }
            
            //$installment = $section->sectionInstallments()->where('section_id', $section_id)->first();

            $total_pay = $amount + $studentInvoice->amount_paid;
            $balance = $cost - $total_pay;

            $note = '';
            $in_cost = 0;

            foreach ($installments as $value) {
                
                $sectionInstallment = SectionInstallment::where('installment_id', '=', $value->id)->first();
                if ($sectionInstallment == null) {
                    break;
                }

                $in_cost = $in_cost + $sectionInstallment->amount;
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

            //dd($note);

            Payment::create([
               'student_invoice_id' => $studentInvoice->invoice_id,
                'amount_paid' => $amount,
                'currency' => strtolower($currency),
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
            throw $th;
        }
        
    }

    //public function get 


}