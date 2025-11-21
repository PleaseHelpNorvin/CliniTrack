<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Referral;

class ReferralController extends Controller
{
    //.
    public function index(Request $request)
    {
        $search = $request->input('search');

        $statuses = [
            Referral::STATUS_REFERRED,
            Referral::STATUS_IN_TREATMENT,
            Referral::STATUS_RETURNED,
            Referral::STATUS_COMPLETED,
        ];

        $referralsByStatus = [];
        foreach ($statuses as $status) {
            $query = Referral::with('visit.student')
                ->where('status', $status);

            if ($search) {
                $query->whereHas('visit.student', function($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%");
                })
                ->orWhereHas('visit', function($q) use ($search) {
                    $q->where('reason', 'like', "%$search%");
                });
            }

            $referralsByStatus[$status] = $query->latest('created_at')->get();
        }

        return view('nurse_pages.referral_pages.index', compact('referralsByStatus', 'search'));
    }
    
    public function show(Referral $referral)
    {
        $referral->load('visit.student', 'histories');
        return view('nurse_pages.referral_pages.show', compact('referral'));
    }

    public function edit(Referral $referral)
    {
        return view('nurse_pages.referral_pages.edit', compact('referral'));
    }

    public function updateStatus(Request $request, Referral $referral)
    {
        $request->validate([
            'status' => 'required|in:in_treatment,returned,completed',
        ]);

        $referral->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Referral status updated successfully.');
    }

    // public function addHistory(Request $request, Referral $referral)
    // {
    //     $request->validate([
    //         'perform_by'    => 'required|string|max:255',
    //         'bp'            => 'nullable|string|max:20',
    //         'temp'          => 'nullable|numeric',
    //         'pulse'         => 'nullable|integer',
    //         'resp_rate'     => 'nullable|integer',
    //         'o2_sat'        => 'nullable|integer',
    //         'treatment'     => 'nullable|string|max:255',
    //         'medicine_given'=> 'nullable|string|max:255',
    //         'nurse_notes'   => 'nullable|string',
    //         'update_type'   => 'required|in:checkup,medication,laboratory,follow_up,final',
    //     ]);

    //     $referral->histories()->create($request->all());

    //     return redirect()->back()->with('success', 'Referral history added successfully.');
    // }
}
