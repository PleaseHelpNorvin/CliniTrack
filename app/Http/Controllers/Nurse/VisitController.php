<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use App\Models\Student;
use App\Services\ActivityLogService;
use App\Constants\ActivityActions;

class VisitController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Visit::with('student')->latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%");
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('visited_at', $request->date);
        }

        if ($request->filled('reason')) {
            $query->where('reason', $request->reason);
        }

        $visits = $query->latest()->paginate(10)->withQueryString();

        return view('nurse_pages.visit_pages.index', compact('visits'));
    }

    public function view(Visit $visit) {
        ActivityLogService::log(ActivityActions::VIEW_VISIT, ['student' => $visit->student->first_name . ' ' . $visit->student->last_name]);
        return view('nurse_pages.visit_pages.view', compact('visit'));
    }

    public function create()
    {
        $students = Student::orderBy('first_name')->get();
        return view('nurse_pages.visit_pages.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'     => 'required|exists:students,id',
            'visited_at'     => 'required|date',
            'reason'         => 'required',
            'status'         => 'required',
            'other_reason'   => 'required_if:reason,other',
            'referred_to'    => 'required_if:status,referred',
            'temperature'    => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'pulse_rate'     => 'nullable|string',
            'treatment_given'=> 'nullable|string',
            'nurse_notes'    => 'nullable|string',
            'emergency'      => 'sometimes|boolean',
        ]);

        $visit = Visit::create([
            'student_id'     => $request->student_id,
            'nurse_id'       => Auth::id(),
            'visited_at'     => $request->visited_at,
            'reason'         => $request->reason, // always enum value
            'other_reason'   => $request->reason === 'other' ? $request->other_reason : null,
            'temperature'    => $request->temperature,
            'blood_pressure' => $request->blood_pressure,
            'pulse_rate'     => $request->pulse_rate,
            'treatment_given'=> $request->treatment_given,
            'nurse_notes'    => $request->nurse_notes,
            'status'         => $request->status,
            'referred_to'    => $request->status === 'referred' ? $request->referred_to : null,
            'emergency'      => $request->has('emergency'),
        ]);
        
        ActivityLogService::log(ActivityActions::ADD_VISIT, ['student' => $visit->student->first_name . ' ' . $visit->student->last_name]);

        return redirect()->route('nurse.visits.index')
                        ->with('success', 'Visit added successfully!');
    }

    public function edit(Visit $visit) {
        $students = Student::orderBy('first_name')->get();
        return view('nurse_pages.visit_pages.edit', compact('visit', 'students'));
    }

    public function update(Request $request, Visit $visit) {
        $validated = $request->validate([
            'student_id'     => 'required|exists:students,id',
            'visited_at'     => 'required|date',
            'reason'         => 'required',
            'status'         => 'required',
            'other_reason'   => 'required_if:reason,other',
            'referred_to'    => 'required_if:status,referred',
            'temperature'    => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'pulse_rate'     => 'nullable|string',
            'treatment_given'=> 'nullable|string',
            'nurse_notes'    => 'nullable|string',
            'emergency'      => 'sometimes|boolean',
        ]);

        $visit->update([
            'student_id'     => $request->student_id,
            'visited_at'     => $request->visited_at,
            'reason'         => $request->reason,
            'other_reason'   => $request->reason === 'other' ? $request->other_reason : null,
            'temperature'    => $request->temperature,
            'blood_pressure' => $request->blood_pressure,
            'pulse_rate'     => $request->pulse_rate,
            'treatment_given'=> $request->treatment_given,
            'nurse_notes'    => $request->nurse_notes,
            'status'         => $request->status,
            'referred_to'    => $request->status === 'referred' ? $request->referred_to : null,
            'emergency'      => $request->has('emergency'),
        ]);

        ActivityLogService::log(ActivityActions::ADD_VISIT, ['student' => $visit->student->first_name . ' ' . $visit->student->last_name]);

        return redirect()->route('nurse.visits.index')->with('success', 'Visit updated successfully!');
    }


    public function destroy(Visit $visit) {
        $visit->delete();

        ActivityLogService::log(ActivityActions::ADD_VISIT, ['student' => $visit->student->first_name . ' ' . $visit->student->last_name]);

        return redirect()->route('nurse.visits.index')->with('success', 'Visit deleted successfully!');
    }
}
