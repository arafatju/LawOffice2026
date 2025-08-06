<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $table = 'personalinfo';

    protected $fillable = ['userid', 'name', 'mobile', 'designation', 'office', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
}

