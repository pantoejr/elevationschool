<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'full_name',
        'dob',
        'phone',
        'gender',
        'email',
        'address',
        'photo',
        'user_id',
        'status',
        'created_by',
        'updated_by'
    ];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
