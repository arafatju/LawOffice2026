<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notarydetails extends Model
{
    use HasFactory;
    protected $table = 'notaryinfo'; // Only needed if table name is not plural or different
     
     
    protected $fillable = [
        'applicationid', 
        'barnumber', 
        'bardate', 
        'lawnumber', 
        'lawdate', 
        'exp',
        'notarysarok',
        'natarydate',
        'area',
        'renewdate',
        'lastrenewdate',
         
         
    ];
    

}
