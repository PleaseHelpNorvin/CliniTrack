<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'student_number',
        'grade_level',
        'section',
        'dob',
        'contact_number',
        'email',
    ];

    // Relationship: a student can have many visits
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    // Relationship: a student can have many notifications
    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class);
    // }
}
