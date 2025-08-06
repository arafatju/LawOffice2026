<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
class Allotment extends Model
{
    protected $table = 'allotment';

    protected $fillable = ['userid', 'prcode', 'quantity','designation'];
   protected $casts = [
        'quantity' => 'integer', // or 'decimal:2' if you used decimal
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

    public function product()
    {
        return $this->belongsTo(ProductInfo::class, 'prcode', 'prcode');
    }
}
