@extends('admin.layouts.app')

@section('title', 'Settings')

@section('page-title', 'Settings')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
<style>

    .settings-nav .nav-link {
        color: #555;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 18px;
        margin-right: 8px;
    }

    .settings-nav .nav-link.active {
        background: #d6a84f;
        color: #111;
    }

    .current-logo {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #eee;
    }

</style>
@endpush

@section('content')

<div class="container-fluid px-0">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
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


    <ul class="nav settings-nav mb-4" id="settingsTab" role="tablist">

        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#accountTab" type="button">
                <i class="bi bi-person-circle"></i> Account
            </button>
        </li>

        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#generalTab" type="button">
                <i class="bi bi-gear"></i> General
            </button>
        </li>

    </ul>


    <div class="tab-content">

        {{-- ================= ACCOUNT (EMAIL + PASSWORD) ================= --}}

        <div class="tab-pane fade show active" id="accountTab">

            <div class="card shadow-sm admin-form-card">

                <div class="card-header">
                    <h6 class="mb-0">Account Settings</h6>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.settings.account') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', $admin->email ?? '') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                                <small class="text-muted">Required to confirm any changes.</small>
                            </div>

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

                        <div class="admin-form-actions">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle"></i>
                                Update Account
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- ================= GENERAL SETTINGS ================= --}}

        <div class="tab-pane fade" id="generalTab">

            <div class="card shadow-sm admin-form-card">

                <div class="card-header">
                    <h6 class="mb-0">General Settings</h6>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.settings.general') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="site_name" class="form-control"
                                       value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Email</label>
                                <input type="email" name="contact_email" class="form-control"
                                       value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" name="contact_phone" class="form-control"
                                       value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Site Logo</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">

                                @if(!empty($settings['site_logo']))
                                    <img src="{{ asset($settings['site_logo']) }}" class="current-logo mt-2">
                                @endif
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ old('address', $settings['address'] ?? '') }}</textarea>
                            </div>

                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle"></i>
                                Save General Settings
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection