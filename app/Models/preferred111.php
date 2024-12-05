<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preferred111 extends Model
{
    use HasFactory;
    protected $table = 'preferred_five_districts';

    // The attributes that are mass assignable
    protected $fillable = [
        'userid', 
        'district', 
        'reason'
    ];
}
