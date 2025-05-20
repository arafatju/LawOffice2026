<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notarydetails extends Model
{
    use HasFactory;
    protected $table = 'notaryinfo'; // Only needed if table name is not plural or different
     
     
    protected $fillable = [
        'applicationid', 
        'barnumber', 
        'bardate', 
        'lawnumber', 
        'lawdate', 
        'exp',
        'notarysarok',
        'natarydate',
        'area',
        'renewdate',
        'lastrenewdate',
         
         
    ];
    public function isApproved()
    {
        // If equal, the application is approved
        return $this->renewdate === $this->lastrenewdate;
    }
    
    /**
     * Check if application is expired
     * 
     * @return bool
     */
    public function isExpired()
    {
        // If not equal, the application is expired
        return $this->renewdate !== $this->lastrenewdate;
    }
    
    /**
     * Scope for approved applications (renewdate equals lastrenewdate)
     */
    public function scopeApproved($query)
    {
        return $query->whereRaw('renewdate = lastrenewdate');
    }
    
    /**
     * Scope for expired applications (renewdate does not equal lastrenewdate)
     */
    public function scopeExpired($query)
    {
        return $query->whereRaw('renewdate != lastrenewdate');
    }
    

}
