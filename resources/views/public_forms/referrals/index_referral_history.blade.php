@extends('layouts.public_layout')

@section('title', 'Medical Tracker Form')
@section('page-title', 'Medical Tracker Form')

@section('content')
<div class="container mt-5">

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form action="{{ route('public.referral_histories.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search student or reason...">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student</th>
                            <th>Visit Date</th>
                            <th>Reason</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($referrals as $referral)
                        <tr>
                            <td>{{ $referral->id }}</td>
                            <td>{{ $referral->visit->student->first_name ?? '-' }} {{ $referral->visit->student->last_name ?? '' }}</td>
                            <td>{{ $referral->visit->visited_at?->format('M d, Y') ?? '-' }}</td>
                            <td>{{ $referral->visit->reason ?? '-' }}</td>
                            <td>
                                <a href="{{ route('public.referral_histories.create', $referral->id) }}" class="btn btn-sm btn-primary">
                                    Select Referral
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No referrals found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $referrals->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
