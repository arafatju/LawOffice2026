<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wifeinfo extends Model
{
    use HasFactory;
    protected $table = 'wifeinfo'; // Only needed if table name is not plural or different

     
    protected $fillable = [
       'userid', 
        'wifename', 
        'profession', 
        'designation', 
        'wifeworkplace', 
        'wifehomedistrict', 
        'kids_number'
    ];
}
