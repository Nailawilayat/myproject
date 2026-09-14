@extends('student.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Welcome, {{ $studentName }} 👋</h3>
    <p class="text-muted mb-0">Here's your learning overview.</p>
</div>


<div class="row g-4 mb-4">

    <div class="col-md-4">
        <a href="{{ route('user.course') }}" class="stat-card-link">
            <div class="card border-0 shadow-sm h-100 stat-card">
                <div class="card-body">
                    <div class="stat-icon-box icon-bg-primary mb-3">
                        <i class="bi bi-book-fill"></i>
                    </div>
                    <p class="stat-label mb-1">My Course</p>
       <h2 class="stat-number text-dark mb-0" style="font-size: 20px;">
    {{ $courseName ?? 'Not Enrolled' }}
</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('user.books') }}" class="stat-card-link">
            <div class="card border-0 shadow-sm h-100 stat-card">
                <div class="card-body">
                    <div class="stat-icon-box icon-bg-success mb-3">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                    <p class="stat-label mb-1">Available Books</p>
                    <h2 class="stat-number text-dark mb-0">{{ $booksCount }}</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body">
                <div class="stat-icon-box icon-bg-warning mb-3">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <p class="stat-label mb-1">Status</p>
                <h2 class="stat-number text-dark mb-0" style="font-size: 20px;">
                    {{ !empty($student->course) ? 'Enrolled' : 'Pending' }}
                </h2>
            </div>
        </div>
    </div>

</div>


<div class="card border-0 shadow-sm">
    <div class="card-body">

        <h5 class="fw-bold mb-4">Quick Actions</h5>

        <div class="row g-3">

            <div class="col-md-6">
                <a href="{{ route('user.course') }}" class="btn btn-outline-primary w-100 py-3">
                    <i class="bi bi-book me-2"></i>
                    View My Course
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('user.books') }}" class="btn btn-outline-success w-100 py-3">
                    <i class="bi bi-journal-bookmark me-2"></i>
                    Browse Books
                </a>
            </div>

        </div>

    </div>
</div>

@endsection