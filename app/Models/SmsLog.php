<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = ['trid', 'userid', 'mobile', 'message', 'status', 'response', 'sent_at'];
    protected $casts = ['sent_at' => 'datetime'];
}
