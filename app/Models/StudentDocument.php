<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    protected $fillable = [
        'student_id',
        'name', // original file name
        'path', // storage path
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getUrlAttribute()
    {
        return $this->path ? asset('storage/' . $this->path) : null;
    }
}
