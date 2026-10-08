<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $table = 'productinfo';

    protected $fillable = ['quantity', 'name', 'prcode', 'category','status'];
protected $casts = [
        'quantity' => 'integer', // or 'decimal:2' if you used decimal
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'prcode', 'prcode');
    }

    public function allotments()
    {
        return $this->hasMany(Allotment::class, 'prcode', 'prcode');
    }
     

}

