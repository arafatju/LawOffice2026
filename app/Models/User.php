<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'device',
        'location',
        'mobile',
        'role',
        'avatar',
        'userid'
    ];

    protected $table = 'users';

    protected $hidden = [
        'password',
    ];

    // ✅ Relationships

    public function personalInfo()
    {
        return $this->hasOne(PersonalInfo::class, 'userid', 'userid');
    }
    public function applications()
{
    return $this->hasMany(ApplicationInfo::class, 'userid', 'userid');
}

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'userid', 'userid');
    }

    
}
