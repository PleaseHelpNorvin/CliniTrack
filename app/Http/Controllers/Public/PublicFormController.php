<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student; 
use App\Models\Visit; 
use App\Models\Referral; 
use App\Models\ReferralHistory; 
use App\Models\ReferralAttachment; 

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
                    'first_name' => ['required','regex:/^[A-Za-z\s\-]+$/', 'max:255'],
                    'last_name'  => ['required','regex:/^[A-Za-z\s\-]+$/', 'max:255'],
                    'student_number' => ['required', 'numeric', 'unique:students,student_number'],
                    'grade_level' => 'required|integer',
                    'grade_level_other' => 'nullable|string|max:50',
                    'section' => 'nullable|string|max:50',
                    'dob' => 'required|date',
                    'contact_number' => ['required', 'regex:/^[0-9]+$/', 'max:20'],
                    'email' => 'required|email|max:255',   
                    'address' => 'required|string',
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    'allergies' => ['nullable','regex:/^[A-Za-z\s\-]+$/', 'max:255'],
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
            'student_id'   => 'required|exists:students,id',
            'visited_at'   => 'required|date',
            'reason'       => 'required',
            'other_reason' => 'required_if:reason,other',
            'emergency'    => 'sometimes|boolean',
        ]);

        $visit = Visit::create([
            'student_id'   => $request->student_id,
            'nurse_id'     => null, // not assigned yet
            'visited_at'   => $request->visited_at,
            'reason'       => $request->reason,
            'other_reason' => $request->reason === 'other' ? $request->other_reason : null,
            'status'       => 'unassigned', // default for new visit requests
            'emergency'    => $request->has('emergency'),
        ]);

        ActivityLogService::log(ActivityActions::FILL_PUBLIC_VISIT_FORM, [
            'student' => $visit->student->first_name . ' ' . $visit->student->last_name
        ]);

        return redirect()->route('public.visit.create')->with('success', 'Visit request submitted successfully!');
    }

    public function indexReferralHistory(Request $request) {
        $search = $request->query('search');

        $referrals = Referral::query()
            ->with('visit.student')
            ->when($search, function($query, $search) {
                $query->whereHas('visit.student', function($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('student_number', 'like', "%{$search}%");
                })
                ->orWhereHas('visit', function($q) use ($search) {
                    $q->where('reason', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString(); // keeps search term in pagination links

        return view('public_forms.referrals.index_referral_history', compact('referrals', 'search'));
    }

    public function createReferralHistory(Referral $referral) {
        return view('public_forms.referrals.create_referral_history', compact('referral'));
    }

    public function storeReferralHistory(Request $request)
    {
        $request->validate([
            'referral_id'    => 'required|exists:referrals,id',
            'perform_by'     => 'required|string|max:255',
            'bp'             => 'nullable|string|max:20',
            'temp'           => 'nullable|string|max:10',
            'pulse'          => 'nullable|string|max:10',
            'resp_rate'      => 'nullable|string|max:10',
            'o2_sat'         => 'nullable|string|max:10',
            'treatment'      => 'nullable|string',
            'medicine_given' => 'nullable|string',
            'nurse_notes'    => 'nullable|string',
            'update_type'    => 'required|string|in:checkup,medication,laboratory,follow_up,final',
        ]);

        

        ReferralHistory::create($request->all());
        
        $referral = Referral::findOrFail($request->referral_id);
        $referral->status = Referral::STATUS_IN_TREATMENT;
        $referral->save();  

        return redirect()->route('public.referral_histories.index')->with('success', 'Referral history created!');
    }


    public function storeReferralAttachment(Request $request, $referralId)
    {
        // Validate (multiple files allowed)
        $request->validate([
            'attachments.*' => 'required|file|max:5120', // 5MB each file
        ]);

        // Check if files exist
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {

                // Store file inside storage/app/public/referral_attachments
                $path = $file->store('referral_attachments', 'public');

                // Save file record to DB
                ReferralAttachment::create([
                    'referral_id' => $referralId,
                    'file_name'   => $file->getClientOriginalName(),
                    'file_path'   => $path,
                ]);
            }
        }

        return back()->with('success', 'Attachments uploaded successfully!');
    }


}
