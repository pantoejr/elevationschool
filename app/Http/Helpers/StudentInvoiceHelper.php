<?php

namespace App\Http\Helpers;

use App\Models\StudentInvoice;




class StudentInvoiceHelper
{
    public function getStudentInvoice(int $studentId)
    {
        
        $invoices = StudentInvoice::where('student_id', $studentId)->get();
        if ($invoices->isEmpty()) {
            return null;
        }

        return [
            'invoices' => $invoices,
        ];
    }

    public function createStudentInvoice(array $data)
    {
        try {
            StudentInvoice::create([
                'student_section_id' => $data['student_section_id'],
                'amount_paid' => $data['amount_paid'],
                'balance' => $data['balance'],
                'due_date' => $data['due_date'],
                'currency' => $data['currency'],
                'is_completed' => $data['is_completed']
            ]);

            return [
                'status' => true,
                'message' => 'Student invoice created successfully.'
            ];

        } catch (\Throwable $th) {
            //throw $th;
            return [
                'status' => false,
                'message' => 'An error occurred while creating the student invoice: ' . $th->getMessage(),
            ];
        }
    }

    public function updateStudentInvoice(int $invoiceId, array $data)
    {
        try {
            $invoice = StudentInvoice::findOrFail($invoiceId);
            $invoice->update(
                [
                    'student_section_id' => $data['student_section_id'],
                    'amount_paid' => $data['amount_paid'],
                    'balance' => $data['balance'],
                    'due_date' => $data['due_date'],
                    'currency' => $data['currency'],
                    'is_completed' => $data['is_completed']
                ]);

            return [
                'status' => true,
                'message' => 'Student invoice updated successfully.'
            ];

        } catch (\Throwable $th) {
            //throw $th;
            return [
                'status' => false,
                'message' => 'An error occurred while updating the student invoice: ' . $th->getMessage(),
            ];
        }
    }
    public function deleteStudentInvoice(int $invoiceId)
    {
        try {
            $invoice = StudentInvoice::findOrFail($invoiceId);
            $invoice->delete();

            return [
                'status' => true,
                'message' => 'Student invoice deleted successfully.'
            ];

        } catch (\Throwable $th) {
            //throw $th;
            return [
                'status' => false,
                'message' => 'An error occurred while deleting the student invoice: ' . $th->getMessage(),
            ];
        }
    }
}