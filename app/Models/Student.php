<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'photo',
        'last_name',
        'first_name',
        'middle_name',
        'date_of_birth',
        'gender',
        'marital_status',
        'place_of_birth_town',
        'place_of_birth_city',
        'place_of_birth_country',
        'nationality',
        'official_language',
        'permanent_address_town',
        'permanent_address_city',
        'permanent_address_country',
        'mobile_phone',
        'email',
        'father_name',
        'mother_name',
        'emergency_contact_name',
        'emergency_contact_number',
        'computer_literacy',
        'education_status',
        'course_applying_for',
        'is_new',
        'status',
        'created_by',
        'updated_by'
    ];
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function studentSections(){
        return $this->hasMany(StudentSection::class);
    }
}
