<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student; 
use App\Models\Visit; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Constants\ActivityActions;
use App\Services\ActivityLogService;

class PublicFormController extends Controller
{
    public function createStudentProfile()
    {
        return view('public_forms.create_student_profile'); // your Blade file
    }

    // Handle form submission
    public function StoreStudentProfile(Request $request)
    {
        $data = $request->validate([
                    'first_name' => 'required|string|max:255',
                    'last_name'  => 'required|string|max:255',
                    'student_number' => 'required|string|max:50|unique:students,student_number',
                    'grade_level' => 'required|integer',
                    'grade_level_other' => 'nullable|string|max:50',
                    'section' => 'nullable|string|max:50',
                    'dob' => 'required|date',
                    'contact_number' => 'required|string|max:20',
                    'email' => 'required|email|max:255',   
                    'address' => 'required|string',
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    'allergies' => 'nullable|max:255',
                    'medical_notes' => 'nullable|max:255'
                ]);

                // Handle profile photo
                if ($request->hasFile('photo')) {
                    $data['photo'] = $request->file('photo')->store('students/photos', 'public');
                }

                $student = Student::create($data);

                // Handle documents
                if ($request->hasFile('documents')) {
                    foreach($request->file('documents') as $file){
                        $path = $file->store('students/documents', 'public');
                        $student->documents()->create([
                            'name' => $file->getClientOriginalName(),
                            'path' => $path,
                            'type' => $file->getMimeType(),
                            'extension' => $file->getClientOriginalExtension(),
                        ]);
                    }
                }

                ActivityLogService::log(ActivityActions::FILL_PUBLIC_STUDENT_FORM, ['student' => $student->first_name . ' ' . $student->last_name]);
        return redirect()->back()->with('success', 'Student profile submitted successfully!');
    }


    public function createVisit()
    {
        $students = Student::orderBy('first_name')->get();
        return view('public_forms.create_visit', compact('students'));
    }

    public function storeVisit(Request $request)
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
        
        ActivityLogService::log(ActivityActions::FILL_PUBLIC_VISIT_FORM, ['student' => $visit->student->first_name . ' ' . $visit->student->last_name]);
        return redirect()->route('')->with('success', 'Visit updated successfully!');
    }
}
