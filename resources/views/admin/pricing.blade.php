@extends('admin.layouts.app')

@section('title', 'Pricing')

@section('page-title', 'Pricing')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
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

    <div class="d-flex justify-content-between align-items-center mb-4 admin-page-header">

        <h5 class="mb-0">Pricing Plans</h5>

        <a href="{{ route('admin.pricing.create') }}" class="btn btn-warning">
            <i class="bi bi-plus-circle"></i>
            Add Plan
        </a>

    </div>


    <div class="card shadow-sm admin-table-card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle admin-table">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Plan Name</th>
                            <th>Days/Week</th>
                            <th>Free Trial</th>
                            <th>Minutes/Day</th>
                            <th>Age/Gender</th>
                            <th>Support</th>
                            <th>Class Type</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pricings as $index => $plan)

                            <tr>
                                <td data-label="#">{{ $index + 1 }}</td>

                                <td data-label="Plan Name">
                                    <strong>{{ $plan->plan_name }}</strong>
                                </td>

                                <td data-label="Days/Week">
                                    {{ $plan->days_per_week_text ?? $plan->days_per_week }}
                                </td>

                                <td data-label="Free Trial">
                                    {{ $plan->free_trial_days }} Days
                                </td>

                                <td data-label="Minutes/Day">
                                    {{ $plan->minutes_per_day }} min
                                </td>

                                <td data-label="Age/Gender">
                                    {{ $plan->age_gender }}
                                </td>

                                <td data-label="Support">
                                    {{ $plan->support }}
                                </td>

                                <td data-label="Class Type">
                                    {{ $plan->class_type }}
                                </td>

                                <td data-label="Action">

                                    <div class="d-flex gap-1">

                                        <a href="{{ route('admin.pricing.edit', $plan->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.pricing.delete', $plan->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this plan?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center text-muted admin-empty-state">
                                    <i class="bi bi-currency-dollar" style="font-size: 40px;"></i>
                                    <h6 class="mt-3">No pricing plans found.</h6>
                                    <a href="{{ route('admin.pricing.create') }}" class="btn btn-warning btn-sm mt-2">
                                        <i class="bi bi-plus-circle"></i>
                                        Add First Plan
                                    </a>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection