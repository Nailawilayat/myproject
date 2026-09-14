@extends('admin.layouts.app')

@section('title', 'Assigned Courses')

@section('page-title', 'Assigned Courses')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
<style>

    .teacher-block {
        border-radius: 12px;
        transition: box-shadow 0.2s ease;
    }

    .teacher-block:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important;
    }

    .teacher-avatar {
        width: 50px;
        height: 50px;
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

    .course-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f8f6f0;
        border: 1px solid #eee0c2;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 13px;
        color: #333;
        margin: 4px 6px 4px 0;
    }

    .course-chip i {
        color: #d6a84f;
    }

    .no-course-text {
        font-size: 13px;
        color: #aaa;
        font-style: italic;
    }

</style>
@endpush

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4 admin-page-header">

        <h5 class="fw-bold mb-0">
            Assigned Courses
        </h5>

        <span class="badge bg-primary">
            {{ $teachers->count() }} Teachers
        </span>

    </div>


    @forelse($teachers as $teacher)

        <div class="card border-0 shadow-sm mb-3 teacher-block">

            <div class="card-body">

                <div class="d-flex align-items-center gap-3 mb-3">

                    <div class="teacher-avatar">
                        {{ strtoupper(substr($teacher->name, 0, 1)) }}
                    </div>

                    <div>
                        <h6 class="fw-bold mb-0">{{ $teacher->name }}</h6>
                        <small class="text-muted">{{ $teacher->email }}</small>
                    </div>

                    <span class="badge bg-{{ $teacher->courses->count() > 0 ? 'success' : 'secondary' }} ms-auto">
                        {{ $teacher->courses->count() }} Course{{ $teacher->courses->count() != 1 ? 's' : '' }}
                    </span>

                </div>

                <hr>

                @if($teacher->courses->count() > 0)

                    <div>
                        @foreach($teacher->courses as $course)
                            <span class="course-chip">
                                <i class="bi bi-book-fill"></i>
                                {{ $course->title }}
                                @if($course->status == 1)
                                    <span class="badge bg-success" style="font-size:10px;">Active</span>
                                @else
                                    <span class="badge bg-secondary" style="font-size:10px;">Inactive</span>
                                @endif
                            </span>
                        @endforeach
                    </div>

                @else

                    <p class="no-course-text mb-0">
                        No courses assigned to this teacher yet.
                    </p>

                @endif

            </div>

        </div>

    @empty

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center admin-empty-state">
                <i class="bi bi-person-video3" style="font-size: 40px; color: #ccc;"></i>
                <h6 class="mt-3">No teachers found.</h6>
            </div>
        </div>

    @endforelse

</div>

@endsection