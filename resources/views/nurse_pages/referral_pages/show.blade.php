@extends('layouts.nurse_layout')

@section('title', 'Referral Details')
@section('page-title', 'Referral Details')

@section('content')


<!-- Student Profile Card -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">Student Info</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ $referral->visit->student->photo 
                    ? asset('storage/' . $referral->visit->student->photo) 
                    : asset('App/images/no-image-default.jpg') }}" 
                    alt="Student Photo" class="img-fluid rounded">
            </div>
            <div class="col-md-10">
                <h5>{{ $referral->visit->student->first_name }} {{ $referral->visit->student->last_name }}</h5>
                <p><strong>Grade:</strong> {{ $referral->visit->student->grade_level }}</p>
                <p><strong>Section:</strong> {{ $referral->visit->student->section }}</p>
                <p><strong>Visited At:</strong> {{ $referral->visit->visited_at?->format('M d, Y h:i A') }}</p>
                <p><strong>Reason:</strong> {{ ucfirst($referral->visit->reason) }}</p>
                <p><strong>Allergies:</strong> {{ ucfirst($referral->visit->student->allergies) }}</p>

            </div>
        </div>
    </div>
</div>

<!-- Referral Card with Tabs -->
<div class="card shadow-sm">
    <div class="card-header bg-success text-white fw-bold">Referral Details</div>
    <div class="card-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs mb-3" id="referralTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button">Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button">History</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="attachments-tab" data-bs-toggle="tab" data-bs-target="#attachments" type="button">Attachments</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="referralTabsContent">
            <!-- Details -->
            <div class="tab-pane fade show active" id="details" role="tabpanel">
                <p><strong>Status:</strong> {{ ucfirst(str_replace('_',' ', $referral->status)) }}</p>
                <p><strong>Referred By:</strong> {{ $referral->visit->nurse_name ?? '-' }}</p>
                <p><strong>Referred To:</strong> {{ $referral->referred_to ?? '-' }}</p>
                <p><strong>Notes:</strong> {{ $referral->notes ?? '-' }}</p>
                <hr>
                <h6>Initial Findings / Why Referred</h6>
                <p><strong>Temperature:</strong> {{ $referral->visit->temperature ?? '-' }}</p>
                <p><strong>Blood Pressure:</strong> {{ $referral->visit->blood_pressure.'mmHg' ?? '-'}}</p>
                <p><strong>Pulse Rate:</strong> {{ $referral->visit->pulse_rate ?? '-'}}</p>
                <p><strong>Treatment Given:</strong> {{ $referral->visit->treatment_given ?? '-'}}</p>
                <p><strong>Reason:</strong> {{ $referral->visit->reason ?? '-' }}</p>
                <p><strong>Other Notes:</strong> {{ $referral->visit->nurse_notes ?? '-' }}</p>
            </div>

            <!-- History -->
            <div class="tab-pane fade" id="history" role="tabpanel">
                @forelse($referral->histories as $history)
                    <div class="card mb-2">
                        <div class="card-body">
                            <strong>{{ $history->update_type }} by {{ $history->perform_by }}</strong> <br>
                            BP: {{ $history->bp ?? 'N/A' }}, Temp: {{ $history->temp ?? 'N/A' }},
                            Pulse: {{ $history->pulse ?? 'N/A' }}, O2: {{ $history->o2_sat ?? 'N/A' }} <br>
                            Treatment: {{ $history->treatment ?? 'N/A' }} <br>
                            Medicine: {{ $history->medicine_given ?? 'N/A' }} <br>
                            Notes: {{ $history->nurse_notes ?? 'N/A' }} <br>
                            <small class="text-muted">{{ $history->created_at->format('M d, Y h:i A') }}</small>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">No referral history yet.</div>
                @endforelse
            </div>

            <!-- Attachments -->
            <div class="tab-pane fade" id="attachments" role="tabpanel">
                @forelse($referral->attachments as $file)
                    <p>
                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ $file->file_name }}</a>
                    </p>
                @empty
                    <div class="alert alert-info">No attachments yet.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>

@endsection
