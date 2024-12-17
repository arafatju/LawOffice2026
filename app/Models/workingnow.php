<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workingnow extends Model
{
    use HasFactory;
    protected $table = 'working_now';

    // The attributes that are mass assignable
    protected $fillable = [
        'userid',
        'district',
        'designation',
        'mobile',
        'status',
        'situation',
        'start',
         
        'status2',
        'GO_Date',
        'sarok',
        'office'
    ];
}
