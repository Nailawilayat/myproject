@extends('students.layouts.app')

@section('title', 'Live Classes')
@section('page-title', 'Live Classes')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <h5 class="fw-bold mb-4">Upcoming Live Classes</h5>

        @forelse($classes as $class)

            <div class="card border-0 {{ $class->is_live ? 'border-danger border-2' : 'bg-light' }} mb-3">
                <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        @if($class->is_live)
                            <span class="badge bg-danger mb-2">
                                <i class="bi bi-broadcast"></i> LIVE NOW
                            </span>
                        @endif

                        <h6 class="fw-bold mb-1">{{ $class->title }}</h6>
                        <small class="text-muted">
                            {{ $class->course_title }} &bull;
                            {{ \Carbon\Carbon::parse($class->scheduled_at)->format('d M Y, h:i A') }}
                        </small>
                    </div>

                    <a href="{{ $class->meeting_link }}" target="_blank"
                       class="btn {{ $class->is_live ? 'btn-danger' : 'btn-warning' }}">
                        <i class="bi bi-camera-video-fill"></i>
                        {{ $class->is_live ? 'Join Now' : 'Join Class' }}
                    </a>

                </div>
            </div>

        @empty

            <div class="text-center text-muted py-5">
                <i class="bi bi-camera-video" style="font-size: 40px;"></i>
                <h6 class="mt-3">No live classes scheduled for your course yet.</h6>
            </div>

        @endforelse

    </div>
</div>

@endsection