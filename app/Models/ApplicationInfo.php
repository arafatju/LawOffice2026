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

    // Updated relationship to properly link with transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'trid', 'role');
    }

    // Helper method to get approved transaction
    public function getApprovedTransaction()
    {
        return $this->transactions()->where('status', 'approved')->first();
    }

    // Helper method to check if application is completed
    public function isCompleted()
    {
        return $this->transactions()->where('status', 'approved')->exists();
    }

    // Helper method to get all products for this application
    public function getProducts()
    {
        return $this->transactions()->with('product')->get();
    }
}