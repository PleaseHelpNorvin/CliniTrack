<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralHistory extends Model
{
        protected $fillable = [
        'referral_id',
        'perform_by',
        'bp',
        'temp',
        'pulse',
        'resp_rate',
        'o2_sat',
        'treatment',
        'medicine_given',
        'nurse_notes',
        'update_type',
    ];

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

}
