<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'visit_id',
        'referred_to',
        'status',
        'notes',
    ];

    // Status constants
    public const STATUS_REFERRED      = 'referred';
    public const STATUS_IN_TREATMENT  = 'in_treatment';
    public const STATUS_RETURNED      = 'returned';
    public const STATUS_COMPLETED     = 'completed';

    // Relationships
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function histories()
    {
        return $this->hasMany(ReferralHistory::class);
    }

    public function attachments()
    {
        return $this->hasMany(ReferralAttachment::class);
    }

    // Check status helpers
    public function isReferred(): bool
    {
        return $this->status === self::STATUS_REFERRED;
    }

    public function isInTreatment(): bool
    {
        return $this->status === self::STATUS_IN_TREATMENT;
    }

    public function isReturned(): bool
    {
        return $this->status === self::STATUS_RETURNED;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}
