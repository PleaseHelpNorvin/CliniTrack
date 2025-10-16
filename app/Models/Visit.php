<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'student_id',
        'nurse_id',
        'visit_time',
        'reason',
        'notes',
        'status',
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
}
