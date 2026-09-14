@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles') <link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid admin-dashboard px-0">

{{-- ================= WELCOME ================= --}}
<div class="dashboard-welcome mb-4">

    <h3 class="fw-bold">
        Welcome to Admin Dashboard 👋
    </h3>

    <p class="text-muted mb-0">
        Manage Sultana Quran Academy from one place.
    </p>

</div>


{{-- ================= STATISTICS ================= --}}
<div class="row g-4 stats-row mb-4">

    {{-- STUDENTS --}}
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

        <a href="{{ route('admin.students') }}"
           class="stat-card-link">

            <div class="card border-0 shadow-sm h-100 stat-card">

                <div class="card-body">

                    <div class="stat-icon-box icon-bg-primary mb-3">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>

                    <p class="stat-label mb-1">
                        Total Students
                    </p>

                    <h2 class="stat-number text-dark mb-1">
                        {{ $studentsCount ?? 0 }}
                    </h2>

                    <span class="text-primary view-link">
                        View all students
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

            </div>

        </a>

    </div>


    {{-- TEACHERS --}}
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

        <a href="{{ route('admin.teachers') }}"
           class="stat-card-link">

            <div class="card border-0 shadow-sm h-100 stat-card">

                <div class="card-body">

                    <div class="stat-icon-box icon-bg-success mb-3">
                        <i class="bi bi-person-video3"></i>
                    </div>

                    <p class="stat-label mb-1">
                        Total Teachers
                    </p>

                    <h2 class="stat-number text-dark mb-1">
                        {{ $teachersCount ?? 0 }}
                    </h2>

                    <span class="text-success view-link">
                        View all teachers
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

            </div>

        </a>

    </div>


    {{-- COURSES --}}
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

        <a href="{{ route('admin.courses') }}"
           class="stat-card-link">

            <div class="card border-0 shadow-sm h-100 stat-card">

                <div class="card-body">

                    <div class="stat-icon-box icon-bg-warning mb-3">
                        <i class="bi bi-book-fill"></i>
                    </div>

                    <p class="stat-label mb-1">
                        Total Courses
                    </p>

                    <h2 class="stat-number text-dark mb-1">
                        {{ $coursesCount ?? 0 }}
                    </h2>

                    <span class="course-view-link view-link">
                        View all courses
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

            </div>

        </a>

    </div>


    {{-- BOOKS --}}
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

        <a href="{{ route('admin.books') }}"
           class="stat-card-link">

            <div class="card border-0 shadow-sm h-100 stat-card">

                <div class="card-body">

                    <div class="stat-icon-box icon-bg-danger mb-3">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>

                    <p class="stat-label mb-1">
                        Total Books
                    </p>

                    <h2 class="stat-number text-dark mb-1">
                        {{ $booksCount ?? 0 }}
                    </h2>

                    <span class="text-danger view-link">
                        View all books
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

            </div>

        </a>

    </div>

</div>


{{-- ================= QUICK ACTIONS ================= --}}
<div class="card border-0 shadow-sm quick-actions-card">

    <div class="card-body">

        <h5 class="fw-bold mb-4">
            Quick Actions
        </h5>

        <div class="row g-3">

            {{-- ADD TEACHER --}}
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

                <a href="{{ route('admin.teachers.create') }}"
                   class="btn btn-outline-primary w-100 py-3 quick-action-btn">

                    <i class="bi bi-person-plus-fill me-2"></i>

                    Add Teacher

                </a>

            </div>


            {{-- ADD COURSE --}}
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

                <a href="{{ route('admin.courses.create') }}"
                   class="btn btn-outline-success w-100 py-3 quick-action-btn">

                    <i class="bi bi-plus-circle-fill me-2"></i>

                    Add Course

                </a>

            </div>


            {{-- ADD BOOK --}}
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

                <a href="{{ route('admin.books.create') }}"
                   class="btn btn-outline-warning w-100 py-3 quick-action-btn">

                    <i class="bi bi-journal-plus me-2"></i>

                    Add Book

                </a>

            </div>


            {{-- ADD STUDENT --}}
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

                <a href="{{ route('admin.students.create') }}"
                   class="btn btn-outline-danger w-100 py-3 quick-action-btn">

                    <i class="bi bi-person-plus-fill me-2"></i>

                    Add Student

                </a>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection
