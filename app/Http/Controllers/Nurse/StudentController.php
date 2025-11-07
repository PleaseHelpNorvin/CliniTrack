<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    //
    public function index() {
        return view('nurse_pages.student_pages.index');
    }

    public function create() {

    }

    public function store() {
        
    }

    public function view(Student $student) {
        $student->load(['visits.nurse', 'documents']);
        return view('nurse_pages.student_pages.view', compact('student'));
    }

}
