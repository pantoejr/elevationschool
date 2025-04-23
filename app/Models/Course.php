<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'cost',
        'currency',
        'duration',
        'description',
        'created_by',
        'updated_by'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
