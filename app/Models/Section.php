<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
        'course_id',
        'faculty_id',
        'start_date',
        'end_date',
        'status',
        'no_of_students',
        'created_by',
        'updated_by'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }
}
