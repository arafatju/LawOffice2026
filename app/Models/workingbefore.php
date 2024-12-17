<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workingbefore extends Model
{
    use HasFactory;
    protected $table = 'working_before';

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
        'sarok',
        'office',
        'GO_Date2',
        'sarok2'
    ];
}
