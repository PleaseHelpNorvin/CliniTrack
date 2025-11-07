@extends('layouts.nurse_layout')

@section('title', 'Visits')
@section('page-title', 'Patient Visits')

@section('content')


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('nurse.visits.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Visit
            </a>
        </div>

        {{-- 🔍 Filter Section --}}
        <!-- <div class="d-flex gap-2 mb-3"> -->
            <form method="GET" action="{{ route('nurse.visits.index') }}" class="d-flex gap-2 mb-3">
                <input type="text" name="search" class="form-control w-25" placeholder="Search by student..." value="{{ request('search') }}">
                <input type="date" name="date" class="form-control w-25" value="{{ request('date') }}">
                <select name="reason" class="form-select w-25">
                    <option value="">All Reasons</option>
                    <option value="sick" {{ request('reason') == 'sick' ? 'selected' : '' }}>sick</option>
                    <option value="injury" {{ request('reason') == 'injury' ? 'selected' : '' }}>injury</option>
                    <option value="checkup" {{ request('reason') == 'checkup' ? 'selected' : '' }}>checkup</option>
                    <option value="headache" {{ request('reason') == 'headache' ? 'selected' : '' }}>headache</option>
                    <option value="fever" {{ request('reason') == 'fever' ? 'selected' : '' }}>fever</option>
                    <option value="stomachache" {{ request('reason') == 'stomachache' ? 'selected' : '' }}>stomachache</option>
                    <option value="menstrual" {{ request('reason') == 'menstrual' ? 'selected' : '' }}>menstrual</option>
                    <option value="asthma" {{ request('reason') == 'asthma' ? 'selected' : '' }}>asthma</option>
                    <option value="toothache" {{ request('reason') == 'toothache' ? 'selected' : '' }}>toothache</option>
                    <option value="other" {{ request('reason') == 'other' ? 'selected' : '' }}>other</option>
                </select>

                    <input type="text" name="other_reason" id="other_reason" 
                    class="form-control w-25 {{ request('reason') != 'other' ? 'd-none' : '' }}" 
                    placeholder="Enter other reason" value="{{ request('other_reason') }}">

                <button class="btn btn-secondary" type="submit">Filter</button>
            </form>
        <!-- </div> -->

        {{-- 📋 Visits Table --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="min-width: 700px;">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Reason</th>
                        <th>Visit Time</th>
                        <th>Status</th>
                        <th>Nurse Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visits as $index => $visit)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $visit->student->first_name }} {{ $visit->student->last_name }}</td>
                            <td>
                                @if($visit->reason === 'other')
                                    {{ $visit->other_reason ?? 'Other' }}
                                @else
                                    {{ ucfirst($visit->reason) }}
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($visit->visited_at)->format('Y-m-d h:i A') }}</td>
                            <td>
                                @php
                                    $statusClass = match($visit->status) {
                                        'treated'   => 'success',
                                        'referred'  => 'warning',
                                        'sent_home' => 'secondary',
                                        default     => 'light'
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $visit->status)) }}</span>
                            </td>
                            <td>{{ $visit->nurse_notes ?? '-' }}</td>
                            <td>
                                <a href="{{ route('nurse.visits.view', $visit->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('nurse.visits.edit', $visit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('nurse.visits.destroy', $visit->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure you want to delete this visit?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    const reasonSelect = document.getElementById('reason');
    const otherInput = document.getElementById('other_reason');

    reasonSelect.addEventListener('change', function() {
        if (this.value === 'other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
            otherInput.value = '';
        }
    });
</script>
@endsection
