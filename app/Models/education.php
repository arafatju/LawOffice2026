<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    use HasFactory;

    protected $table = 'educationinfo'; // Only needed if table name is not plural or different
     
     
    protected $fillable = [
        'applicationid', 
        'sscpass', 
        'hscpass', 
        'edu1', 
        'edu2', 
         
         
         
    ];

    
}
