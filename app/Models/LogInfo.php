<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogInfo extends Model
{
    use HasFactory;

    protected $table = 'loginfo';

    protected $fillable = [
        'name',
        'mobile',
        'mail',
        'Device',
        'Browser',
        'ip',
        'Location',
    ];

    
}
