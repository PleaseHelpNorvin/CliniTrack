<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;
use App\Constants\ActivityActions;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    //
    public function index(Request $request) {
                $query = Student::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('student_number', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('grade_level_other', 'like', "%{$search}%");

                $gradeMap = [
                    'Grade 11' => 11,
                    'Grade 12' => 12,
                    '1st Year College' => 21,
                    '2nd Year College' => 22,
                    '3rd Year College' => 23,
                    '4th Year College' => 24,
                ];

                foreach ($gradeMap as $text => $num) {
                    if (stripos($text, $search) !== false) {
                        $q->orWhere('grade_level', $num);
                    }
                }

                if (stripos('No Grade level selected', $search) !== false) {
                    $q->orWhere(function($sub) {
                        $sub->whereNull('grade_level')
                            ->orWhere('grade_level', 0)
                            ->whereNull('grade_level_other');
                    });
                }

                $q->orWhere('section', 'like', "%{$search}%");

                if (stripos('No section', $search) !== false) {
                    $q->orWhereNull('section');
                }

                $q->orWhereRaw("first_name || ' ' || last_name LIKE ?", ["%{$search}%"]);
            });
        }
        // Pagination (10 per page)
        $students = $query->orderBy('id', 'desc')->paginate(10);

        // Keep search/filter params in pagination links
        $students->appends($request->all());
        return view('nurse_pages.student_pages.index', compact('students'));
    }

    public function create() {
        return view('nurse_pages.student_pages.create');
    }

    public function store(Request $request) {
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

        ActivityLogService::log(ActivityActions::ADD_STUDENT, ['student' => $student->first_name . ' ' . $student->last_name]);
        return redirect()->route('nurse.students.view', $student)->with('success', 'Student added successfully');

    } 
    
    public function view(Student $student) {
        $student->load(['visits.nurse', 'documents']);
        return view('nurse_pages.student_pages.view', compact('student'));
    }

    public function Edit(Student $student) 
    {
        $student->load(['visits.nurse', 'documents']);
        return view('nurse_pages.student_pages.edit', compact('student'));

    } 


    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_number' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'grade_level' => 'nullable',
            'grade_level_other' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'contact_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'allergies' => 'nullable|string|max:255',
            'medical_notes' => 'nullable|string|max:5000',
        ]);

        if ($request->hasFile('photo')) {
            if ($student->photo && Storage::exists('public/' . $student->photo)) {
                Storage::delete('public/' . $student->photo);
            }

            $validated['photo'] = $request->file('photo')->store('students/photos', 'public');
        }

        $student->update($validated);

        ActivityLogService::log(ActivityActions::UPDATE_STUDENT, ['student' => $student->first_name . ' ' . $student->last_name]);

        return redirect()
            ->route('nurse.students.view', $student->id)
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        if ($student->photo && Storage::exists('public/' . $student->photo)) {
            Storage::delete('public/' . $student->photo);
        }

        foreach ($student->documents as $doc) {
            if ($doc->path && Storage::exists('public/' . $doc->path)) {
                Storage::delete('public/' . $doc->path);
            }
        }

        $student->delete();

        ActivityLogService::log(ActivityActions::DELETE_STUDENT, ['student' => $student->first_name . ' ' . $student->last_name]);

        return redirect()
            ->route('nurse.students.index')
            ->with('success', 'Student deleted successfully!');
    }


}
