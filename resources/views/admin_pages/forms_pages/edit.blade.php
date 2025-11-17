@extends('layouts.admin_layout')

@section('title', 'Edit Form')
@section('page-title', 'Edit Form')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-light fw-bold">
        Edit Form
    </div>
    <div class="card-body">

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.forms.update', $form->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Form Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $form->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $form->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $form->type) }}" required>
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link (URL)</label>
                <input type="url" name="link" id="link" class="form-control" value="{{ old('link', $form->link) }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="active" {{ old('status', $form->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $form->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_public" id="is_public" class="form-check-input" value="1" {{ old('is_public', $form->is_public) ? 'checked' : '' }}>
                <label for="is_public" class="form-check-label">Publicly Visible?</label>
            </div>

            <button type="submit" class="btn btn-success">Update Form</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
</div>
@endsection
