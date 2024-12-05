<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class childinfo extends Model
{
    use HasFactory;
    protected $table = 'childinfo'; // Only needed if table name is not plural or different

     
    protected $fillable = [
        'userid', 
        'name', 
        'age', 
        'educationtype', 
        'educationlocation', 
        'educationname'
    ];
}
