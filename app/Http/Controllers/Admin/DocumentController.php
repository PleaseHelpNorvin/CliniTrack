<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentDocument;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class DocumentController extends Controller
{
    //
    public function create(Student $student)
    {
        $prefix = request()->route()->getPrefix();
        // dd($prefix, request()->route()->getName());

        $role = Auth::user()->role;

        $storeRoute = $role === 'admin'
            ? route('admin.documents.store')
            : route('nurse.documents.store');
        return view('admin_pages.document_pages.create', compact('student', 'storeRoute'));
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
        $role = Auth::user()->role;

       $routeName = $role === 'admin'
        ? 'admin.students.view'
        : 'nurse.students.view';


        return redirect()
            ->route($routeName, $request->student_id)
            ->with('success', 'Document uploaded successfully!');
    }

        public function destroy(Request $request, StudentDocument $document)
        {
            // Delete file from storage
            Storage::disk('public')->delete($document->path);
            $document->delete();

            // Get authenticated user's role
            $role = Auth::user()->role;

            // Determine redirect route based on role
            $routeName = $role === 'admin'
                ? 'admin.students.view'
                : 'nurse.students.view';

            // Redirect back to the student's view with success message
            return redirect()
                ->route($routeName, $document->student_id)
                ->with('success', 'Document deleted successfully.');
        }

    
}
