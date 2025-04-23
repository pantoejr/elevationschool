<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSection extends Model
{
    protected $fillable = [
        'student_id',
        'section_id',
        'status',
        'created_by',
        'updated_by'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
