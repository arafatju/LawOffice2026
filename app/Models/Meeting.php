<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Meeting extends Model
{
    /** meeting type: stored key => label shown on screen and in the PDF */
    const TYPES = [
        'meeting'  => 'সভা',
        'seminar'  => 'সেমিনার',
        'workshop' => 'ওয়ার্কশপ',
    ];

    protected $fillable = [
        'meeting_code', 'user_id',
        'category', 'institute_id', 'directorate_id', 'section_id',
        'participant_name', 'participant_email', 'participant_mobile', 'participant_designation',
        'meeting_type', 'meeting_name', 'meeting_keyword', 'meeting_contents',
        'attended', 'meeting_at',
        'attachment_path', 'attachment_name', 'attachment_size',
    ];

    protected $casts = [
        'attended'   => 'boolean',
        'meeting_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Auto-generate the unique meeting id when a meeting is created
        static::creating(function (Meeting $meeting) {
            if (empty($meeting->meeting_code)) {
                $meeting->meeting_code = static::makeCode();
            }
        });
    }

    public static function makeCode(): string
    {
        do {
            $code = 'MTG-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        } while (static::where('meeting_code', $code)->exists());

        return $code;
    }

    /** label of this meeting's type (সভা / সেমিনার / ওয়ার্কশপ) */
    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->meeting_type] ?? '';
    }

    /* ---------- Relations ---------- */

    // the ministry / autonomous body / NGO / other chosen
    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }

    // directorate (only when the category is ministry)
    public function directorate(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'directorate_id');
    }

    // section (শাখা) of that directorate
    public function section(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'section_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'userid');
    }
}