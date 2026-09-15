@include('layouts.header')

@php
    function resolveImagePath($path) {
        if (empty($path)) return null;
        return str_starts_with($path, 'courses/')
            ? asset('storage/' . $path)
            : asset($path);
    }
@endphp

<section class="page-banner">
    <div class="overlay"></div>
    <div class="container content position-relative">
        <h1 class="banner-title">{{ $course->title }}</h1>
        <div class="breadcrumb-wrap">
            <a href="{{ url('/') }}">Home</a> /
            <a href="{{ url('/courses') }}">Courses</a> /
            <span>{{ $course->title }}</span>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <div class="row">

            <div class="col-lg-8">

                @if($course->image)
                    <img src="{{ resolveImagePath($course->image) }}"
                         alt="{{ $course->title }}"
                         class="img-fluid rounded mb-4 course-main-image">
                @endif

                <h3 class="fw-bold mb-3">{{ $course->title }}</h3>

                <div class="d-flex flex-wrap gap-3 mb-4 text-muted">
                    <span><i class="bi bi-tag-fill me-1"></i>{{ $course->category ?? 'General' }}</span>
                    @if($course->level)
                        <span><i class="bi bi-bar-chart-fill me-1"></i>{{ ucfirst($course->level) }}</span>
                    @endif
                    @if($course->duration)
                        <span><i class="bi bi-clock-fill me-1"></i>{{ $course->duration }}</span>
                    @endif
                    @if($course->language)
                        <span><i class="bi bi-translate me-1"></i>{{ $course->language }}</span>
                    @endif
                </div>

                @if($course->overview)
                    <div class="content-card mb-4">
                        <h5 class="fw-bold mb-3">Course Overview</h5>
                        <p style="line-height: 1.8;">{{ $course->overview }}</p>
                    </div>
                @endif

                @if($course->teacher)
                    <div class="teacher-card mb-4">

                        @if($course->teacher_image)
                            <img src="{{ resolveImagePath($course->teacher_image) }}" alt="{{ $course->teacher }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light rounded-circle"
                                 style="width:140px; height:140px;">
                                <i class="bi bi-person-fill" style="font-size: 50px; color: #ccc;"></i>
                            </div>
                        @endif

                        <div>
                            <h5 class="fw-bold mb-1">{{ $course->teacher }}</h5>
                            <p class="text-muted mb-2">{{ $course->teacher_designation }}</p>
                            @if($course->teacher_bio)
                                <p class="mb-0">{{ $course->teacher_bio }}</p>
                            @endif
                        </div>

                    </div>
                @endif

                {{-- REVIEWS --}}
                @if($course->reviews && $course->reviews->count() > 0)
                    <div class="content-card mt-4">
                        <h5 class="fw-bold mb-3">Student Reviews</h5>

                        @foreach($course->reviews as $review)
                            <div class="review-card mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>{{ $review->name }}</strong>
                                    <span class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </span>
                                </div>
                                <p class="mb-0">{{ $review->comment }}</p>
                            </div>
                        @endforeach

                    </div>
                @endif

            </div>

            <div class="col-lg-4">

                <div class="sidebar-card mb-4">

                    <h5 class="sidebar-title">Course Features</h5>

                    <ul class="course-info-list">
                        <li>
                            <span><i class="bi bi-camera-video-fill"></i> Lectures</span>
                            <strong>{{ $course->lectures ?? 0 }}</strong>
                        </li>
                        <li>
                            <span><i class="bi bi-patch-question-fill"></i> Quizzes</span>
                            <strong>{{ $course->quizzes ?? 0 }}</strong>
                        </li>
                        <li>
                            <span><i class="bi bi-people-fill"></i> Students</span>
                            <strong>{{ $course->students ?? 0 }}</strong>
                        </li>
                        <li>
                            <span><i class="bi bi-bar-chart-fill"></i> Level</span>
                            <strong>{{ ucfirst($course->level ?? 'N/A') }}</strong>
                        </li>
                    </ul>

                    <a href="{{ url('/apply') }}" class="btn btn-gold w-100 mt-3">
                        Apply Now
                    </a>

                </div>

                @if($popularCourses->count() > 0)
                    <div class="sidebar-card popular-courses-sticky">
                        <h5 class="sidebar-title">Popular Courses</h5>

                        @foreach($popularCourses as $popular)
                            <a href="{{ url('/courses/' . $popular->slug) }}"
                               class="d-block mb-3 text-decoration-none text-dark">
                                <strong>{{ $popular->title }}</strong>
                                <br>
                                <small class="text-muted">{{ $popular->category ?? 'General' }}</small>
                            </a>
                        @endforeach

                    </div>
                @endif

            </div>

        </div>

        @if($relatedCourses->count() > 0)
            <div class="mt-5">
                <h4 class="fw-bold mb-4">You May Like</h4>

                <div class="row g-4">
                    @foreach($relatedCourses as $related)
                        <div class="col-md-4">
                            <div class="course-card h-100">

                                @if($related->image)
                                    <img src="{{ resolveImagePath($related->image) }}"
                                         class="course-img w-100" alt="{{ $related->title }}">
                                @endif

                                <div class="p-3">
                                    <h6 class="fw-bold">{{ $related->title }}</h6>
                                    <a href="{{ url('/courses/' . $related->slug) }}"
                                       class="btn btn-sm btn-gold mt-2">
                                        View Course
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>

@include('layouts.footer')