@extends('layouts.nurse_layout')

@section('title', 'Update Referral')
@section('page-title', 'Update Referral')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
        Update Referral
    </div>

    <div class="card-body">

        <form action="{{ route('nurse.referral.update', $referral->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Referred To</label>
                <input type="text" class="form-control" value="{{ $referral->referred_to }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="pending" {{ $referral->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $referral->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $referral->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Follow-Up Date</label>
                <input type="date" name="follow_up_date" class="form-control"
                       value="{{ $referral->follow_up_date }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Notes</label>
                <textarea name="notes" class="form-control" rows="3">{{ $referral->notes }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Referral</button>
            <a href="{{ route('nurse.referral.show', $referral->visit_id) }}" class="btn btn-secondary">Back</a>
        </form>

    </div>
</div>

@endsection
