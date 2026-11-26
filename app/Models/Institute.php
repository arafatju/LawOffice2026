<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institute extends Model
{
    public const MINISTRY    = 'ministry';      // মন্ত্রণালয়/বিভাগ
    public const DIRECTORATE = 'directorate';   // অধিদপ্তর/দপ্তর/সংস্থা  (parent = ministry)
    public const SECTION     = 'section';       // শাখা (parent = directorate) - managed on another page
    public const AUTONOMOUS  = 'autonomous';    // স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা
    public const NGO         = 'ngo';           // এনজিও
    public const OTHER       = 'other';         // অন্যান্য

    /** Every type that can exist in the table */
    public const TYPES = [
        self::MINISTRY,
        self::DIRECTORATE,
        self::SECTION,
        self::AUTONOMOUS,
        self::NGO,
        self::OTHER,
    ];

    /** Types that may be created from the "প্রতিষ্ঠান সমূহ" page (sections are NOT created here) */
    public const FORM_TYPES = [
        self::MINISTRY,
        self::DIRECTORATE,
        self::AUTONOMOUS,
        self::NGO,
        self::OTHER,
    ];

    /** Bengali labels */
    public const LABELS = [
        self::MINISTRY    => 'মন্ত্রণালয়/বিভাগ',
        self::DIRECTORATE => 'অধিদপ্তর/দপ্তর/সংস্থা',
        self::SECTION     => 'শাখা',
        self::AUTONOMOUS  => 'স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা',
        self::NGO         => 'এনজিও',
        self::OTHER       => 'অন্যান্য',
    ];

    protected $fillable = ['type', 'name', 'parent_id', 'created_by'];

    public function label(): string
    {
        return self::LABELS[$this->type] ?? $this->type;
    }

    /* ---------- Relations ---------- */

    // A directorate belongs to a ministry
    public function ministry(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // A section belongs to a directorate
    public function directorate(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // A ministry has many directorates
    public function directorates(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
                    ->where('type', self::DIRECTORATE);
    }

    // A directorate has many sections
    public function sections(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
                    ->where('type', self::SECTION);
    }

    /* ---------- Scopes ---------- */

    public function scopeMinistries($q)       { return $q->where('type', self::MINISTRY); }
    public function scopeOnlyDirectorates($q) { return $q->where('type', self::DIRECTORATE); }
    public function scopeOnlySections($q)     { return $q->where('type', self::SECTION); }
    public function scopeAutonomous($q)       { return $q->where('type', self::AUTONOMOUS); }
    public function scopeNgos($q)             { return $q->where('type', self::NGO); }
    public function scopeOthers($q)           { return $q->where('type', self::OTHER); }
}