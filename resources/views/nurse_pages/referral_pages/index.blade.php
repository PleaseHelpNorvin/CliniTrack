@extends('layouts.nurse_layout')

@section('title', 'Referred Visits')
@section('page-title', 'Referred Visits')

@section('content')
<div class="card shadow-sm">
    {{-- Card Header with Tabs --}}
    <div class="card-header bg-primary text-white fw-bold d-flex flex-column">
        <form method="GET" action="{{ route('nurse.referral.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search by student name or reason...">
                <button class="btn btn-light" type="submit">Search</button>
            </div>
        </form>

        <ul class="nav nav-tabs card-header-tabs" id="referralTabs" role="tablist">
            @foreach($referralsByStatus as $status => $referrals)
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-white @if($loop->first) active @endif" 
                            id="{{ $status }}-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#{{ $status }}" 
                            type="button" role="tab" 
                            aria-controls="{{ $status }}" 
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ ucfirst(str_replace('_', ' ', $status)) }} 
                        <span class="badge bg-light text-dark">{{ $referrals->count() }}</span>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Card Body with Tab Content --}}
    <div class="card-body">
        <div class="tab-content" id="referralTabsContent">
            @foreach($referralsByStatus as $status => $referrals)
                <div class="tab-pane fade @if($loop->first) show active @endif" 
                     id="{{ $status }}" role="tabpanel" 
                     aria-labelledby="{{ $status }}-tab">
                    
                    @if($referrals->isEmpty())
                        <div class="alert alert-info">No {{ $status }} visits found.</div>
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
            @endforeach
        </div>
    </div>
</div>
@endsection
