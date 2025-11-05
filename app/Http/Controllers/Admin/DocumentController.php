<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentDocument;
use App\Models\Student;

class DocumentController extends Controller
{
    //
    public function create(Student $student)
    {
        // send student id to view
        return view('admin_pages.document_pages.create', compact('student'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:2048'
        ]);

        $path = $request->file('file')->store('student_documents', 'public');

        StudentDocument::create([
            'student_id' => $request->student_id,
            'name' => $request->name,
            'path' => $path
        ]);

        return redirect()
            ->route('admin.students.view', $request->student_id)
            ->with('success', 'Document uploaded successfully!');
    }

    public function destroy(StudentDocument $document)
    {
        \Storage::disk('public')->delete($document->path);
        $document->delete();

        return back()->with('success', 'Document deleted.');
    }

    
}
