<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\ReferralHistory;

class ReferralHistoryController extends Controller
{
    public function store(Request $request, Referral $referral)
    {
        $request->validate([
            'perform_by'    => 'required|string|max:255',
            'bp'            => 'nullable|string|max:20',
            'temp'          => 'nullable|numeric',
            'pulse'         => 'nullable|integer',
            'resp_rate'     => 'nullable|integer',
            'o2_sat'        => 'nullable|integer',
            'treatment'     => 'nullable|string|max:255',
            'medicine_given'=> 'nullable|string|max:255',
            'nurse_notes'   => 'nullable|string',
            'update_type'   => 'required|in:checkup,medication,laboratory,follow_up,final',
        ]);

        $referral->histories()->create($request->all());

        return redirect()->back()->with('success', 'Referral history added successfully.');
    }
}
