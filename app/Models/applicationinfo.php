<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicationinfo extends Model
{
    use HasFactory;
    protected $table = 'apllicationinfo'; // Only needed if table name is not plural or different
     
     
    protected $fillable = [
        'userid', 
        'status', 
        'applicationid', 
         
         
    ];
}
