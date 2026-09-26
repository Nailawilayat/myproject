@extends('students.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">
        Welcome, {{ $studentName ?? 'Student' }} 👋
    </h3>
    <p class="text-muted mb-0">
        Here's your learning overview.
    </p>
</div>


<div class="row g-4 mb-4">

    <div class="col-md-4">
        <a href="{{ route('user.course') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">My Course</p>
                    <h5 class="fw-bold mb-0 text-dark">
                        {{ $courseName ?? 'Not Enrolled' }}
                    </h5>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('user.books') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Available Books</p>
                    <h5 class="fw-bold mb-0 text-dark">
                        {{ $booksCount ?? 0 }}
                    </h5>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-1">Course Level</p>
                <h5 class="fw-bold mb-0">
                    {{ $matchedCourse->level ?? 'N/A' }}
                </h5>
            </div>
        </div>
    </div>

</div>


@if($matchedCourse)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-2">
                {{ $matchedCourse->title }}
            </h6>
            <p class="text-muted mb-0">
                {{ $matchedCourse->overview ?? 'No overview available.' }}
            </p>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        You are not currently enrolled in any matched course.
    </div>
@endif


{{-- ================= QUICK ACTIONS ================= --}}

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <h5 class="fw-bold mb-4">Quick Actions</h5>

        <div class="row g-3">

            <div class="col-md-4">
                <a href="{{ route('user.course') }}" class="btn btn-outline-primary w-100 py-3">
                    <i class="bi bi-book me-2"></i>
                    View My Course
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('user.books') }}" class="btn btn-outline-success w-100 py-3">
                    <i class="bi bi-journal-bookmark me-2"></i>
                    Browse Books
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('user.live-classes') }}" class="btn btn-outline-danger w-100 py-3">
                    <i class="bi bi-camera-video-fill me-2"></i>
                    Live Classes
                </a>
            </div>

        </div>

    </div>

</div>

@endsection