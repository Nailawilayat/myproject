@extends('admin.layouts.app')

@section('title', 'Applications')

@section('page-title', 'Applications')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
<style>

    .application-card {
        border-radius: 12px;
        transition: box-shadow 0.2s ease;
    }

    .application-card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important;
    }

    .application-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #d6a84f;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
        flex-shrink: 0;
    }

    .info-label {
        font-size: 11px;
        text-transform: uppercase;
        color: #999;
        letter-spacing: 0.4px;
        margin-bottom: 2px;
    }

    .info-value {
        font-size: 14px;
        color: #333;
        margin-bottom: 12px;
    }

    .pending-badge {
        font-size: 12px;
        padding: 6px 14px;
        font-weight: 600;
        border-radius: 20px;
    }

    /* ===== Professional Empty State ===== */

    .applications-empty {
        text-align: center;
        padding: 70px 20px;
        border-radius: 14px;
        background: linear-gradient(180deg, #fffdf7 0%, #ffffff 100%);
        border: 1px dashed #e6d5ad;
    }

    .applications-empty .empty-icon-circle {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: rgba(214, 168, 79, 0.12);
        color: #d6a84f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        margin: 0 auto 22px;
    }

    .applications-empty h5 {
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
    }

    .applications-empty p {
        color: #888;
        font-size: 14px;
        max-width: 380px;
        margin: 0 auto;
    }

    .applications-empty .btn {
        margin-top: 20px;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 24px;
    }

    .page-header-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

</style>
@endpush

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4 admin-page-header flex-wrap gap-3">

        <div class="d-flex align-items-center gap-3">

            <div class="page-header-icon">
                <i class="bi bi-file-earmark-person"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-1">Student Applications</h5>
                <p class="text-muted mb-0" style="font-size: 13px;">
                    Students awaiting course assignment
                </p>
            </div>

        </div>

        <span class="badge {{ $students->count() > 0 ? 'bg-warning text-dark' : 'bg-success' }} pending-badge">
            {{ $students->count() }} {{ $students->count() == 1 ? 'Pending' : 'Pending' }}
        </span>

    </div>


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


    @forelse($students as $student)

        <div class="card border-0 shadow-sm mb-3 application-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="application-avatar">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                        <div>
                            <h6 class="fw-bold mb-0">{{ $student->name }}</h6>
                            <small class="text-muted">
                                Applied {{ \Carbon\Carbon::parse($student->created_at)->diffForHumans() }}
                            </small>
                        </div>

                    </div>

                    <form action="{{ route('admin.students.delete', $student->id) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this application?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i>
                            Reject
                        </button>

                    </form>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-3 col-6">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $student->email }}</div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $student->phone ?? 'N/A' }}</div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="info-label">Gender</div>
                        <div class="info-value">{{ ucfirst($student->gender ?? 'N/A') }}</div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="info-label">Interested Course</div>
                        <div class="info-value">
                            <span class="badge bg-secondary">Not Assigned</span>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="info-label">Guardian Name</div>
                        <div class="info-value">{{ $student->guardian_name ?? 'N/A' }}</div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="info-label">Guardian Phone</div>
                        <div class="info-value">{{ $student->guardian_phone ?? 'N/A' }}</div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="info-label">City / Country</div>
                        <div class="info-value">
                            {{ $student->city ?? 'N/A' }}, {{ $student->country ?? 'N/A' }}
                        </div>
                    </div>

                    @if(!empty($student->note))
                        <div class="col-md-3 col-6">
                            <div class="info-label">Note</div>
                            <div class="info-value">{{ $student->note }}</div>
                        </div>
                    @endif

                    @if(!empty($student->address))
                        <div class="col-12">
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $student->address }}</div>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    @empty

        <div class="applications-empty">

            <div class="empty-icon-circle">
                <i class="bi bi-file-earmark-check"></i>
            </div>

            <h5>All caught up!</h5>

            <p>
                There are no pending applications right now. New student
                registrations without an assigned course will appear here.
            </p>

            <a href="{{ route('admin.students.create') }}" class="btn btn-warning">
                <i class="bi bi-person-plus"></i>
                Add Student
            </a>

        </div>

    @endforelse

</div>

@endsection