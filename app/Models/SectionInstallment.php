<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionInstallment extends Model
{
    protected $fillable = [
        'name',
        'section_id',
        'amount',
        'currency',
        'start_date',
        'end_date',
        'created_by',
        'updated_by',
    ];

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
