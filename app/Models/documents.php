<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
    use HasFactory;
    protected $table = 'documents'; // Only needed if table name is not plural or different
     
     
    protected $fillable = [
        'userid', 
        'image', 
        'signature', 
        'barcertificate', 
        'notarycertificate', 
        'nidcertificate',
         
         
    ];
}
