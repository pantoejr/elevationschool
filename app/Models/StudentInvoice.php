<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInvoice extends Model
{
    //
    protected $fillable = [
        'student_section_id',
        'amount_paid',
        'balance',
        'due_date',
        'currency',
        'is_completed',
    ];

    public function studentSection()
    {
        return $this->belongsTo(StudentSection::class);
    }
    
}
