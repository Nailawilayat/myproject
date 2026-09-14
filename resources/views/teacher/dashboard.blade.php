@extends('teacher.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Welcome, {{ $teacherName }} 👋</h3>
    <p class="text-muted mb-0">Here's an overview of your teaching activity.</p>
</div>


<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('teacher.courses') }}" class="stat-card-link">
            <div class="card border-0 shadow-sm h-100 stat-card">
                <div class="card-body">
                    <div class="stat-icon-box icon-bg-primary mb-3">
                        <i class="bi bi-book-fill"></i>
                    </div>
                    <p class="stat-label mb-1">My Courses</p>
                    <h2 class="stat-number text-dark mb-0">{{ $coursesCount }}</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('teacher.students') }}" class="stat-card-link">
            <div class="card border-0 shadow-sm h-100 stat-card">
                <div class="card-body">
                    <div class="stat-icon-box icon-bg-success mb-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <p class="stat-label mb-1">My Students</p>
                    <h2 class="stat-number text-dark mb-0">{{ $studentsCount }}</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body">
                <div class="stat-icon-box icon-bg-warning mb-3">
                    <i class="bi bi-camera-video-fill"></i>
                </div>
                <p class="stat-label mb-1">Total Lectures</p>
                <h2 class="stat-number text-dark mb-0">{{ $lecturesCount }}</h2>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body">
                <div class="stat-icon-box icon-bg-danger mb-3">
                    <i class="bi bi-patch-question-fill"></i>
                </div>
                <p class="stat-label mb-1">Total Quizzes</p>
                <h2 class="stat-number text-dark mb-0">{{ $quizzesCount }}</h2>
            </div>
        </div>
    </div>

</div>


<div class="card border-0 shadow-sm">
    <div class="card-body">

        <h5 class="fw-bold mb-4">Quick Actions</h5>

        <div class="row g-3">

            <div class="col-md-4">
                <a href="{{ route('teacher.courses') }}" class="btn btn-outline-primary w-100 py-3">
                    <i class="bi bi-book me-2"></i>
                    View My Courses
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('teacher.students') }}" class="btn btn-outline-success w-100 py-3">
                    <i class="bi bi-people me-2"></i>
                    View My Students
                </a>
            </div>

           <div class="col-md-4">
    <a href="{{ route('teacher.books') }}" class="btn btn-outline-dark w-100 py-3">
        <i class="bi bi-journal-bookmark me-2"></i>
        View Books
    </a>
</div>

        </div>

    </div>
</div>

@endsection