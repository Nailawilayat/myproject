@extends('teacher.layouts.app')

@section('title', 'Schedule Live Class')
@section('page-title', 'Schedule Live Class')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.live-classes.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">-- Select Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Class Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Tajweed Lesson 3" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Platform</label>
                    <select name="platform" class="form-select" required>
                        <option value="Zoom">Zoom</option>
                        <option value="Google Meet">Google Meet</option>
                        <option value="Jitsi Meet">Jitsi Meet</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Date & Time</label>
                    <input type="datetime-local" name="scheduled_at" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Duration (minutes)</label>
                    <input type="number" name="duration_minutes" class="form-control" value="60" min="15" required>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Meeting Link</label>
                    <input type="url" name="meeting_link" class="form-control"
                           placeholder="https://zoom.us/j/..." required>
                    <small class="text-muted">Paste your Zoom / Google Meet / Jitsi link here.</small>
                </div>

            </div>

            <button type="submit" class="btn btn-warning">
                <i class="bi bi-check-circle"></i> Schedule Class
            </button>

            <a href="{{ route('teacher.live-classes') }}" class="btn btn-secondary">Cancel</a>

        </form>

    </div>
</div>

@endsection