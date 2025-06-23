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
        'schedule',
        'max_students',
        'no_of_students',
        'course_cost',
        'currency',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'schedule' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function sectionInstallments()
    {
        return $this->hasMany(SectionInstallment::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
