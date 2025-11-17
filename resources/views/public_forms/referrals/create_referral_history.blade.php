@extends('layouts.public_layout')

@section('title', 'Add Referral History')
@section('page-title', 'Add Referral History')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="form-tab" data-bs-toggle="tab" data-bs-target="#formTab" type="button" role="tab">
                        Referral Form
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="attach-tab" data-bs-toggle="tab" data-bs-target="#attachTab" type="button" role="tab">
                        Attachments
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="myTabContent">

                <!-- ========================= -->
                <!-- TAB 1: FORM TAB           -->
                <!-- ========================= -->
                <div class="tab-pane fade show active" id="formTab" role="tabpanel">

                    <form action="{{ route('public.referral_histories.store',  $referral->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="referral_id" value="{{ $referral->id }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Performed By</label>
                                <input type="text" name="perform_by" class="form-control @error('perform_by') is-invalid @enderror" value="{{ old('perform_by', 'nurse: ') }}" required>
                                @error('perform_by')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>BP</label>
                                <input type="text" name="bp" class="form-control @error('bp') is-invalid @enderror" value="{{ old('bp') }}">
                                @error('bp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>Temp</label>
                                <input type="text" name="temp" class="form-control @error('temp') is-invalid @enderror" value="{{ old('temp') }}">
                                @error('temp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>Pulse</label>
                                <input type="text" name="pulse" class="form-control @error('pulse') is-invalid @enderror" value="{{ old('pulse') }}">
                                @error('pulse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>Resp Rate</label>
                                <input type="text" name="resp_rate" class="form-control @error('resp_rate') is-invalid @enderror" value="{{ old('resp_rate') }}">
                                @error('resp_rate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>O2 Sat</label>
                                <input type="text" name="o2_sat" class="form-control @error('o2_sat') is-invalid @enderror" value="{{ old('o2_sat') }}">
                                @error('o2_sat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label>Treatment</label>
                                <textarea name="treatment" class="form-control @error('treatment') is-invalid @enderror">{{ old('treatment') }}</textarea>
                                @error('treatment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label>Medicine Given</label>
                                <textarea name="medicine_given" class="form-control @error('medicine_given') is-invalid @enderror">{{ old('medicine_given') }}</textarea>
                                @error('medicine_given')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label>Nurse Notes</label>
                                <textarea name="nurse_notes" class="form-control @error('nurse_notes') is-invalid @enderror">{{ old('nurse_notes') }}</textarea>
                                @error('nurse_notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>Update Type</label>
                                <select name="update_type" class="form-control @error('update_type') is-invalid @enderror">
                                    @php
                                        $updateTypes = ['checkup', 'medication', 'laboratory', 'follow_up', 'final'];
                                    @endphp
                                    @foreach($updateTypes as $type)
                                        <option value="{{ $type }}" {{ old('update_type') == $type ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $type)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('update_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Save History</button>
                            <a href="{{ route('public.referral_histories.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>

                <!-- ========================= -->
                <!-- TAB 2: ATTACHMENTS TAB    -->
                <!-- ========================= -->
                <div class="tab-pane fade" id="attachTab" role="tabpanel">

                    <form action="{{ route('public.referral_attachments.store', $referral->id) }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Upload Attachments</label>
                            <input type="file" name="attachments[]" class="form-control" multiple>
                            <small class="text-muted">You can upload images, PDFs, medical docs, etc.</small>
                        </div>

                        <button type="submit" class="btn btn-success">Upload</button>
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
