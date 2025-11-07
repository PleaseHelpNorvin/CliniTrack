<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use App\Models\Student;


class VisitController extends Controller
{
    //
    public function index()
    {
        $visits = Visit::with('student')->latest()->get();
        return view('nurse_pages.visit_pages.index', compact('visits'));
    }

    public function view() {
        return view('nurse_pages.visit_pages.view');
    }

    public function create()
    {
        // Get all students to select from
        $students = Student::orderBy('first_name')->get();
        return view('nurse_pages.visit_pages.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'visited_at' => 'required|date',
            'reason' => 'required',
            'status' => 'required',
        ]);

        Visit::create([
            'student_id' => $request->student_id,
            'nurse_id' => Auth::id(),
            'visited_at' => $request->visited_at,
            'reason' => $request->reason,
            'temperature' => $request->temperature,
            'blood_pressure' => $request->blood_pressure,
            'pulse_rate' => $request->pulse_rate,
            'treatment_given' => $request->treatment_given,
            'nurse_notes' => $request->nurse_notes,
            'status' => $request->status,
            'referred_to' => $request->referred_to,
            'emergency' => $request->has('emergency'),
        ]);

        return redirect()->route('nurse.visits.index')->with('success', 'Visit added successfully!');
    }
}
