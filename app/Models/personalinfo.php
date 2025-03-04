<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personalinfo extends Model
{
    use HasFactory;
    protected $table = 'personalinfo'; // Only needed if table name is not plural or different
    
     
    protected $fillable = [
        'applicationid',
        'mobile',
        'name',
        'father',
        'mother',
        'dob',
        'permanent',
        'nid',
        'district',
        'present',
        'email'
    ];

}
