@extends('admin.layouts.app')

@section('title', 'Curriculum')

@section('page-title', 'Curriculum')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4 admin-page-header">

        <h5 class="fw-bold mb-0">
            Course Curriculum
        </h5>

        <span class="badge bg-primary">
            {{ $courses->count() }} Courses
        </span>

    </div>


    @forelse($courses as $course)

        <div class="card border-0 shadow-sm mb-3 curriculum-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">

                    <div>
                        <h6 class="fw-bold mb-1">{{ $course->title }}</h6>
                        <small class="text-muted">
                            {{ $course->category ?? 'General' }}
                            @if($course->level)
                                &bull; {{ ucfirst($course->level) }}
                            @endif
                            @if($course->duration)
                                &bull; {{ $course->duration }}
                            @endif
                        </small>
                    </div>

                    <a href="{{ route('admin.courses') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pencil"></i>
                        Manage
                    </a>

                </div>

                @if($course->overview)
                    <p class="text-muted mb-3" style="font-size: 14px;">
                        {{ Str::limit($course->overview, 200) }}
                    </p>
                @endif

                <hr>

                <div class="row g-3">

                    <div class="col-4">
                        <div class="curriculum-stat">
                            <h6>{{ $course->lectures ?? 0 }}</h6>
                            <span>Lectures</span>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="curriculum-stat">
                            <h6>{{ $course->quizzes ?? 0 }}</h6>
                            <span>Quizzes</span>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="curriculum-stat">
                            <h6>{{ $course->students ?? 0 }}</h6>
                            <span>Students</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center admin-empty-state">
                <i class="bi bi-journal-text" style="font-size: 40px; color: #ccc;"></i>
                <h6 class="mt-3">No courses found.</h6>
            </div>
        </div>

    @endforelse

</div>

@endsection