<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotInfo extends Model
{
    use HasFactory;
 
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lotinfo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lotnumber',
        'prcode',
        'purchaseddate',
        'purchasedtype',
        'quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Generate the next lot number
     *
     * @return string
     */
    public static function generateLotNumber()
    {
        $maxId = self::max('id') ?? 0;
        return 'Lot' . ($maxId + 1);
    }

    /**
     * Relationship with ProductInfo (if needed)
     */
    public function product()
    {
        return $this->belongsTo(ProductInfo::class, 'prcode', 'prcode');
    }
}
