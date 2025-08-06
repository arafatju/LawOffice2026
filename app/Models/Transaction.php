<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
class Transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = ['userid', 'trid', 'status', 'prcode', 'number','month','year'];
protected $casts = [
        'number' => 'integer', // or 'decimal:2' if you used decimal
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
