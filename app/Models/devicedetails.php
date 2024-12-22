<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devicedetails extends Model
{
    use HasFactory;
    protected $table = 'device_details'; // Only needed if table name is not plural or different

     
    protected $fillable = [
        'userid', 
        'ip', 
        'region', 
        'browser', 
        'browser_version', 
        'device',
        'device_version'
         
    ];
}
