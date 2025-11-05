<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'student_number',
        'grade_level',
        'grade_level_other',
        'section',
        'dob',
        'contact_number',
        'email',
        'address',
        'photo',
        'allergies',
        'medical_notes',
    ];
    protected $casts = [
        'dob' => 'date',
    ];

    // Relationship: a student can have many visits
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function documents()
    {
        return $this->hasMany(StudentDocument::class);
    }

    public function getAgeAttribute()
    {
        return $this->dob ? Carbon::parse($this->dob)->age : null;
    }

    public function getGradeTextAttribute()
    {
    if (empty($this->grade_level) || $this->grade_level == 0) {
        return $this->grade_level_other ?? 'No Grade level selected';
    }

        $map = [
            11 => 'Grade 11',
            12 => 'Grade 12',
            21 => '1st Year College',
            22 => '2nd Year College',
            23 => '3rd Year College',
            24 => '4th Year College',
        ];

        return $map[$this->grade_level] ?? 'Unknown';
    }

    public function getSectionTextAttribute()
    {
        return $this->section ?? 'No section';
    }

    // Relationship: a student can have many notifications
    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class);
    // }
}
