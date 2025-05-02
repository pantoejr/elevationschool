<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'student_invoice_id',
        'amount_paid',
        'payment_date',
        'currency',
        'payment_method',
        'payment_reference',
        'status',
        'notes',
        'attachment',
    ];

    public function studentInvoice()
    {
        return $this->belongsTo(StudentInvoice::class);
    }
}
