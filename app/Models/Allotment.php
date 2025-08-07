<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
class Allotment extends Model
{
    protected $table = 'allotment';

    protected $fillable = [  'prcode', 'quantity','designation'];
   protected $casts = [
        'quantity' => 'integer', // or 'decimal:2' if you used decimal
    ];
    

    public function product()
    {
        return $this->belongsTo(ProductInfo::class, 'prcode', 'prcode');
    }
}
