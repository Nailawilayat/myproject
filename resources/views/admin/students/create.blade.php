@extends('admin.layouts.app')

@section('title', 'Add Student')
@section('page-title', 'Add Student')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid px-0">

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
            <h5 class="mb-0">Add New Student</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.students.store') }}" method="POST">
                @csrf

                <h6 class="fw-bold mb-3 text-muted">Account Details</h6>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course</label>
                        <input type="text" name="course" class="form-control"
                               value="{{ old('course') }}">
                    </div>

                </div>

                <div class="col-12">
                    <hr class="my-4">
                </div>

                <h6 class="fw-bold mb-3 text-muted">Guardian Details</h6>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Guardian Name</label>
                        <input type="text" name="guardian_name" class="form-control"
                               value="{{ old('guardian_name') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Guardian Phone</label>
                        <input type="text" name="guardian_phone" class="form-control"
                               value="{{ old('guardian_phone') }}">
                    </div>

                </div>

                <div class="col-12">
                    <hr class="my-4">
                </div>

                <h6 class="fw-bold mb-3 text-muted">Address</h6>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control"
                               value="{{ old('city') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control"
                               value="{{ old('country') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Note</label>
                        <input type="text" name="note" class="form-control"
                               value="{{ old('note') }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Full Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                    </div>

                </div>

                <div class="mt-3 admin-form-actions">

                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-person-plus"></i>
                        Save Student
                    </button>

                    <a href="{{ route('admin.students') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection