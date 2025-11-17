<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use App\Models\Referral;

class DiagnosisController extends Controller
{
    public function index()
    {
        $nurseId = Auth::id();
        $statuses = ['unassigned','assigned','in_progress','treated','referred','sent_home'];

        $visit = Visit::with('student')
                    ->where('nurse_id', $nurseId)
                    ->where('status', 'assigned')
                    ->latest('visited_at')
                    ->first(); // only one visit

        return view('nurse_pages.diagnosis_pages.index', compact('visit', 'statuses'));
    }

    // Show diagnosis details for a single visit
    public function store(Request $request, $visitId)
    {
        $visit = Visit::findOrFail($visitId);

        $visit->update([
            'temperature'    => $request->temperature,
            'blood_pressure' => $request->blood_pressure,
            'pulse_rate'     => $request->pulse_rate,
            'treatment_given'=> $request->treatment_given,
            'nurse_notes'    => $request->nurse_notes,
            'status'         => $request->status,
            'referred_to'    => $request->referred_to,
            'emergency'      => $request->emergency,
        ]);

        if ($request->status === 'referred') {
            $visit->referrals()->create([
                'referred_to'    => $request->referred_to,
                'status'         => Referral::STATUS_REFERRED,
                'notes'          => $request->nurse_notes, 
            ]);
        }

        return redirect()->back()->with('success', 'Diagnosis saved successfully.');
    }
}