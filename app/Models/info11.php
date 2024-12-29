<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class info11 extends Model
{
    use HasFactory;
    protected $table = 'info_details'; // Only needed if table name is not plural or different
     
     
    protected $fillable = [
        'name',
        'userid',
         
        'email',
        'type',
        'action',
        'status',
         
    ];
}
