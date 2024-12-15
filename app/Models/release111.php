<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class release111 extends Model
{
    use HasFactory;
    protected $table = 'release_details';

    // The attributes that are mass assignable
    protected $fillable = [
        'userid', 
        'Go_date', 
        'sarok'
    ];
}
