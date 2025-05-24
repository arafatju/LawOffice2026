<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    /**
     * Cast renewdate to Carbon instance for easier date manipulation
     */
    protected $casts = [
        'renewdate' => 'date',
        'lastrenewdate' => 'date',
        'natarydate' => 'date',
        'bardate' => 'date',
        'lawdate' => 'date',
    ];

    /**
     * Check if application is approved (renewdate is in the future or today)
     *
     * @return bool
     */
    public function isApproved()
    {
        // If renewdate is today or in the future, the application is approved
        return $this->renewdate && $this->renewdate >= now()->startOfDay();
    }

    /**
     * Check if application is expired (renewdate has passed)
     *
     * @return bool
     */
    public function isExpired()
    {
        // If renewdate is in the past, the application is expired
        return $this->renewdate && $this->renewdate < now()->startOfDay();
    }

    /**
     * Scope for approved applications (renewdate is today or in the future)
     */
    public function scopeApproved($query)
    {
        return $query->where('renewdate', '>=', now()->startOfDay());
    }

    /**
     * Scope for expired applications (renewdate is in the past)
     */
    public function scopeExpired($query)
    {
        return $query->where('renewdate', '<', now()->startOfDay());
    }

    /**
     * Get days until expiry (positive number) or days since expired (negative number)
     *
     * @return int
     */
    public function getDaysUntilExpiry()
    {
        if (!$this->renewdate) {
            return null;
        }
        
        return now()->startOfDay()->diffInDays($this->renewdate, false);
    }

    /**
     * Check if renewal is due soon (within specified days)
     *
     * @param int $days
     * @return bool
     */
    public function isRenewalDueSoon($days = 30)
    {
        if (!$this->renewdate) {
            return false;
        }
        
        $daysUntilExpiry = $this->getDaysUntilExpiry();
        return $daysUntilExpiry !== null && $daysUntilExpiry <= $days && $daysUntilExpiry >= 0;
    }

    /**
     * Scope for applications expiring within specified days
     */
    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('renewdate', '>=', now()->startOfDay())
                    ->where('renewdate', '<=', now()->addDays($days)->startOfDay());
    }

    /**
     * Get formatted renewal status
     *
     * @return string
     */
    public function getRenewalStatus()
    {
        if ($this->isExpired()) {
            $daysExpired = abs($this->getDaysUntilExpiry());
            return "Expired {$daysExpired} days ago";
        } elseif ($this->isRenewalDueSoon()) {
            $daysLeft = $this->getDaysUntilExpiry();
            return "Expires in {$daysLeft} days";
        } else {
            return "Active";
        }
    }

    /**
     * Relationship with personal info
     */
    public function personalInfo()
    {
        return $this->belongsTo(personalinfo::class, 'applicationid', 'applicationid');
    }
}