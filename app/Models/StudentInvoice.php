<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInvoice extends Model
{
    //
    protected $fillable = [
        'invoice_id',
        'student_section_id',
        'amount_paid',
        'balance',
        'due_date',
        'currency',
        'is_completed',
        'created_by',
        'updated_by'
    ];

    public function studentSection()
    {
        return $this->belongsTo(StudentSection::class);
    }
    
}
