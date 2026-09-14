@extends('student.layouts.app')

@section('title', 'My Course')
@section('page-title', 'My Course')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-body">

        @if($courseName)

            <div class="row">

                <div class="col-md-8">

                    <h4 class="fw-bold mb-2">{{ $matchedCourse->title ?? $courseName }}</h4>

                    @if($matchedCourse)

                        <p class="text-muted mb-3">
                            {{ $matchedCourse->category ?? 'General' }}
                            @if($matchedCourse->level)
                                &bull; {{ ucfirst($matchedCourse->level) }}
                            @endif
                            @if($matchedCourse->duration)
                                &bull; {{ $matchedCourse->duration }}
                            @endif
                        </p>

                        @if($matchedCourse->overview)
                            <p style="line-height: 1.8;">{{ $matchedCourse->overview }}</p>
                        @endif

                        <hr class="my-4">

                        <h6 class="fw-bold mb-3">Instructor</h6>

                        <p class="mb-1"><strong>{{ $matchedCourse->teacher ?? 'N/A' }}</strong></p>
                        <p class="text-muted">{{ $matchedCourse->teacher_designation ?? '' }}</p>

                    @else

                        <p class="text-muted">
                            Additional course details are not available at the moment.
                        </p>

                    @endif

                </div>

                <div class="col-md-4">

                    @if($matchedCourse)

                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">

                                <div class="stat-icon-box icon-bg-primary mx-auto mb-3">
                                    <i class="bi bi-camera-video-fill"></i>
                                </div>

                                <h3 class="fw-bold mb-0">{{ $matchedCourse->lectures ?? 0 }}</h3>
                                <p class="text-muted small mb-3">Lectures</p>

                                <div class="stat-icon-box icon-bg-warning mx-auto mb-3">
                                    <i class="bi bi-patch-question-fill"></i>
                                </div>

                                <h3 class="fw-bold mb-0">{{ $matchedCourse->quizzes ?? 0 }}</h3>
                                <p class="text-muted small mb-0">Quizzes</p>

                            </div>
                        </div>

                    @endif

                </div>

            </div>

        @else

            <div class="text-center py-5 text-muted">
                <i class="bi bi-book" style="font-size: 40px;"></i>
                <h6 class="mt-3">You are not enrolled in any course yet.</h6>
                <p class="small">Please contact the academy for enrollment.</p>
            </div>

        @endif

    </div>
</div>

@endsection