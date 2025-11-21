@extends('layouts.nurse_layout')

@section('title', 'Referred Visits')
@section('page-title', 'Referred Visits')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-success text-white fw-bold">
        Referred Visits
    </div>
    <div class="card-body">
        @if($referrals->isEmpty())
            <div class="alert alert-info">No referred visits found yet.</div>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Grade</th>
                        <th>Section</th>
                        <th>Visited At</th>
                        <th>Reason</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($referrals as $index => $referral)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $referral->visit->student->first_name }} {{ $referral->visit->student->last_name }}</td>
                            <td>{{ $referral->visit->student->grade_text }}</td>
                            <td>{{ $referral->visit->student->section_text }}</td>
                            <td>{{ $referral->visit->visited_at?->format('M d, Y h:i A') }}</td>
                            <td>{{ ucfirst($referral->visit->reason) }}</td>
                            <td>
                                <a href="{{ route('nurse.referral.show', $referral->id) }}" class="btn btn-primary btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
