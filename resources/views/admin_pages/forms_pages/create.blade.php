@extends('layouts.admin_layout')

@section('title', 'Add Form')
@section('page-title', 'Add Form')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-light fw-bold">
            Add New Form
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

            <form action="{{ route('admin.forms.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Form Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type', 'Form') }}" required>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link (URL)</label>
                    <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Save Form</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>
@endsection
