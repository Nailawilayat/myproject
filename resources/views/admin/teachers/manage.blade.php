@extends('admin.layouts.app')

@section('title', 'Manage Teacher Account')
@section('page-title', 'Manage Teacher Account')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid px-0">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm admin-form-card">

        <div class="card-header">
            <h5 class="mb-0">Manage Teacher Account</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.teachers.manage.update') }}" method="POST">
                @csrf
                @method('PUT')

                <h6 class="fw-bold mb-3 text-muted">Select Teacher</h6>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher</label>
                        <select name="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror" required>
                            <option value="">-- Select Teacher --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} ({{ $teacher->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="col-12">
                    <hr class="my-4">
                </div>

                <h6 class="fw-bold mb-3 text-muted">Update Credentials</h6>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">New Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                        <small class="text-muted">Leave blank to keep current password.</small>
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>

                </div>

                <div class="mt-3 admin-form-actions">

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i>
                        Update Teacher
                    </button>

                    <a href="{{ route('admin.teachers') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection