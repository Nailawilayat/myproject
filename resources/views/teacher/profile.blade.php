@extends('teacher.layouts.app')

@section('title', 'Profile')
@section('page-title', 'Profile')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">
        <h5 class="mb-0">My Profile</h5>
    </div>

    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $teacher->name ?? '') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $teacher->email ?? '') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" required>
                    <small class="text-muted">Required to save any changes.</small>
                </div>

                <div class="col-md-6"></div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control">
                    <small class="text-muted">Leave blank to keep current password.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>

            </div>

            <button type="submit" class="btn btn-warning">
                <i class="bi bi-check-circle"></i>
                Update Profile
            </button>

        </form>

    </div>

</div>

@endsection