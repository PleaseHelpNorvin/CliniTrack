<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'student_id',
        'nurse_id',
        'visited_at',
        'reason',
        'temperature',
        'blood_pressure',
        'pulse_rate',
        'treatment_given',
        'nurse_notes',
        'status',
        'referred_to',
        'emergency',
    ];

    // Relationship: visit belongs to a student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship: visit belongs to a nurse/staff (user)
    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }

    public function getNurseNameAttribute()
    {
        return $this->nurse ? $this->nurse->name : 'N/A';
    }
    // use case: {{ $visit->nurse_name }}

}
