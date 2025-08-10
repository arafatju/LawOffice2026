<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationInfo extends Model
{
    use HasFactory;
    protected $table = 'apllicationinfo';

    protected $fillable = [
        
        'userid',
        'action',
        'role',
        'month',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

     
}

