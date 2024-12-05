<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workingdetails extends Model
{
    use HasFactory;
    protected $table = 'working_history_officer';

    // The attributes that are mass assignable
    protected $fillable = [
        'userid',
        'district',
        'designation',
        'mobile',
        'status',
        'situation',
        'start',
        'end',
        'status2',
        'GO_Date',
        'sarok'
    ];
}
