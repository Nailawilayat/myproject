@extends('admin.layouts.app')

@section('title', 'Add Pricing Plan')
@section('page-title', 'Add Pricing Plan')

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
            <h5 class="mb-0">Add New Pricing Plan</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.pricing.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Plan Name</label>
                        <input type="text" name="plan_name" class="form-control"
                               value="{{ old('plan_name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Days Per Week (Number)</label>
                        <input type="number" name="days_per_week" class="form-control"
                               value="{{ old('days_per_week') }}" min="1" max="7" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Days Per Week (Text)</label>
                        <input type="text" name="days_per_week_text" class="form-control"
                               placeholder="e.g. 2-3 Days/week" value="{{ old('days_per_week_text') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Free Trial Days</label>
                        <input type="number" name="free_trial_days" class="form-control"
                               value="{{ old('free_trial_days') }}" min="0">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Minutes Per Day</label>
                        <input type="number" name="minutes_per_day" class="form-control"
                               value="{{ old('minutes_per_day') }}" min="0">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control"
                               value="{{ old('sort_order') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Age / Gender</label>
                        <input type="text" name="age_gender" class="form-control"
                               value="{{ old('age_gender') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Support</label>
                        <input type="text" name="support" class="form-control"
                               value="{{ old('support') }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Class Type</label>
                        <input type="text" name="class_type" class="form-control"
                               value="{{ old('class_type') }}">
                    </div>

                </div>

                <div class="mt-3 admin-form-actions">

                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i>
                        Save Plan
                    </button>

                    <a href="{{ route('admin.pricing') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection