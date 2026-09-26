@extends('teacher.layouts.app')

@section('title', 'Live Classes')
@section('page-title', 'Live Classes')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Scheduled Live Classes</h5>
    <a href="{{ route('teacher.live-classes.create') }}" class="btn btn-warning">
        <i class="bi bi-plus-circle"></i> Schedule Class
    </a>
</div>

<div class="row g-4">

    @forelse($classes as $class)

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 stat-card">
                <div class="card-body">

                    <div class="stat-icon-box icon-bg-primary mb-3">
                        <i class="bi bi-camera-video-fill"></i>
                    </div>

                    <h6 class="fw-bold mb-1">{{ $class->title }}</h6>
                    <p class="text-muted small mb-2">
                        {{ \Carbon\Carbon::parse($class->scheduled_at)->format('d M Y, h:i A') }}
                        &bull; {{ $class->duration_minutes }} min
                    </p>
                    <p class="text-muted small mb-3">Platform: {{ $class->platform }}</p>

                    <a href="{{ $class->meeting_link }}" target="_blank" class="btn btn-sm btn-primary w-100 mb-2">
                        <i class="bi bi-box-arrow-up-right"></i> Join / Start
                    </a>

                    <form action="{{ route('teacher.live-classes.delete', $class->id) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this class?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </form>

                </div>
            </div>
        </div>

    @empty

        <div class="col-12 text-center text-muted py-5">
            <i class="bi bi-camera-video" style="font-size: 40px;"></i>
            <h6 class="mt-3">No live classes scheduled yet.</h6>
        </div>

    @endforelse

</div>

@endsection