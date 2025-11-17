<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralAttachment extends Model
{
    protected $fillable = ['referral_id', 'file_name', 'file_path'];

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }
}
