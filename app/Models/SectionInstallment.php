<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionInstallment extends Model
{
    protected $fillable = [
        'section_id',
        'installment_id',
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

    public function installment(){
        return $this->belongsTo(Installment::class);
    }
}
