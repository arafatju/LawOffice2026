<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personalinfo extends Model
{
    use HasFactory;
    protected $table = 'personalinfo'; // Only needed if table name is not plural or different

     
    protected $fillable = [
        'userid',
        'mobile',
        'name',
        'marital_status',
        'join',
        'retired',
        'email',
        'serviceid',
        'gradation',
    ];

}
