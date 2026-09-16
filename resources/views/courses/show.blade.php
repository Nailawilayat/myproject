@include('layouts.header')
@include('layouts.hero')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/course-page.css') }}">

<div class="container-fluid position-relative mt-4">

    <div class="row gy-4">

        <!-- LEFT CONTENT -->
        <div class="col-lg-8">

            <div class="breadcrumb-wrap">

                <h2 class="fw-bold mb-3">
                    {{ $course->title }}
                </h2>

                <!-- Info -->
                <div class="d-flex flex-wrap gap-4 text-muted mb-3">
                    <div>
                        <strong>Teacher</strong><br>
                        {{ $course->teacher ?? 'N/A' }}
                    </div>

                    <div>
                        <strong>Category</strong><br>
                        {{ $course->category ?? 'General' }}
                    </div>

                    <div>
                        <strong>Review</strong><br>
                        @php
                            $avgRating = ($course->reviews && $course->reviews->count())
                                ? round($course->reviews->avg('rating'))
                                : 0;
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $avgRating ? '⭐' : '☆' }}
                        @endfor
                    </div>
                </div>

                <!-- Main Image -->
                @if($course->image)
                    <img src="{{ resolveMediaPath($course->image, 'image') }}"
                         class="course-main-image img-fluid rounded shadow w-100"
                         alt="{{ $course->title }}">
                @endif

            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-lg-4">

            {{-- POPULAR COURSES --}}
            <div class="sidebar-widget mb-4">
                <h6 class="widget-title">POPULAR COURSES</h6>

                @forelse($popularCourses as $pc)

                    @php
                        $pcAvgRating = ($pc->reviews && $pc->reviews->count())
                            ? round($pc->reviews->avg('rating'))
                            : 5;
                    @endphp

                    <a href="{{ url('/courses/'.$pc->slug) }}" class="text-decoration-none text-dark">
                        <div class="blog-item d-flex mb-3">

                            @if($pc->image)
                                <img src="{{ resolveMediaPath($pc->image, 'image') }}"
                                     width="70"
                                     height="70"
                                     style="object-fit:cover;"
                                     class="me-3 rounded flex-shrink-0">
                            @endif

                            <div class="ms-1">
                                <h6 class="mb-1 recent-post-link">{{ $pc->short_title ?? $pc->title }}</h6>
                                <span class="text-warning small">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $pcAvgRating ? '⭐' : '☆' }}
                                    @endfor
                                </span>
                                <br>
                                <span class="text-success small">Free</span>
                            </div>
                        </div>
                    </a>

                @empty

                    <p class="text-muted mb-0">No popular courses found.</p>

                @endforelse

            </div>

            {{-- COURSE FEATURES --}}
            <div class="sidebar-widget mb-4">
                <h6 class="widget-title">COURSE FEATURES</h6>

                <div class="course-features-box">

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-primary">📄 Lectures</span>
                        <strong>{{ $course->lectures ?? 0 }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-danger">🧩 Quizzes</span>
                        <strong>{{ $course->quizzes ?? 0 }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-warning">⏱ Duration</span>
                        <strong>{{ $course->duration ?? 'N/A' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-info">📶 Skill level</span>
                        <strong>{{ ucfirst($course->level ?? 'N/A') }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-secondary">🌐 Language</span>
                        <strong>{{ $course->language ?? 'N/A' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-danger">👥 Students</span>
                        <strong>{{ $course->students ?? 0 }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2">
                        <span class="text-success">✅ Assessments</span>
                        <strong>{{ ($course->quizzes ?? 0) > 0 ? 'Yes' : 'No' }}</strong>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- TABS SECTION --}}
<div class="container-fluid mt-5">
    <div class="row">

        <div class="col-12">
            <ul class="nav nav-tabs fw-bold flex-nowrap overflow-auto" id="courseTabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#curriculum">Curriculum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#instructor">Instructor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#reviews">Reviews</a>
                </li>
            </ul>

            <div class="tab-content mt-4">

                {{-- OVERVIEW TAB --}}
                <div class="tab-pane fade show active" id="overview">

                    @if($course->overview)
                        <p style="line-height: 1.8;">{{ $course->overview }}</p>
                    @else
                        <p class="text-muted">No overview available for this course yet.</p>
                    @endif

                </div>

                {{-- CURRICULUM TAB --}}
                <div class="tab-pane fade" id="curriculum">

                    <h4 class="fw-bold mb-4">Course Curriculum</h4>

                    <div class="accordion custom-accordion" id="curriculumAccordion">

                        @forelse(($course->curriculum ?? collect()) as $item)

                            <div class="accordion-item border-0 shadow-sm rounded mb-3 overflow-hidden">

                                <h2 class="accordion-header" id="heading{{ $item->id }}">
                                    <button
                                        class="accordion-button collapsed fw-bold"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#lesson{{ $item->id }}"
                                        aria-expanded="false"
                                        aria-controls="lesson{{ $item->id }}">
                                        {{ $item->title }}
                                    </button>
                                </h2>

                                <div id="lesson{{ $item->id }}"
                                     class="accordion-collapse collapse"
                                     data-bs-parent="#curriculumAccordion">

                                    <div class="accordion-body">

                                        @if($item->pdf_file)

                                            @if(session('student_id'))
                                                <a href="{{ route('lesson.pdf', ['file' => $item->pdf_file]) }}"
                                                   class="btn btn-danger fw-bold"
                                                   target="_blank">
                                                    📄 Open PDF
                                                </a>
                                            @else
                                                <a href="{{ route('lesson.pdf', ['file' => $item->pdf_file]) }}"
                                                   class="btn btn-danger fw-bold"
                                                   onclick="showPdfLoginAlert(event, this.href)">
                                                    📄 Open PDF
                                                </a>
                                            @endif

                                        @else
                                            <p class="text-muted mb-0">No file attached for this lesson.</p>
                                        @endif

                                    </div>
                                </div>

                            </div>

                        @empty

                            <p class="text-muted">No curriculum added yet.</p>

                        @endforelse

                    </div>

                </div>

                {{-- INSTRUCTOR TAB --}}
                <div class="tab-pane fade" id="instructor">

                    @if($course->teacher)

                        <div class="d-flex flex-wrap align-items-center gap-4 mt-3">

                            @if($course->teacher_image)
                                <img src="{{ resolveMediaPath($course->teacher_image, 'image') }}"
                                     class="rounded-circle" width="80" height="80"
                                     style="object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($course->teacher) }}&size=80&background=orange&color=fff"
                                     class="rounded-circle" width="80" height="80">
                            @endif

                            <div>
                                <h5 class="fw-bold mb-1">{{ $course->teacher }}</h5>
                                <p class="text-muted mb-1">{{ $course->teacher_designation ?? '' }}</p>
                                <p>{{ $course->teacher_bio ?? '' }}</p>
                            </div>

                        </div>

                    @else

                        <p class="text-muted">Instructor information not available yet.</p>

                    @endif

                </div>

                {{-- REVIEWS TAB --}}
                <div class="tab-pane fade" id="reviews">

                    <h5 class="fw-bold mb-3">Student Reviews</h5>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @forelse(($course->reviews ?? collect()) as $review)

                        <div class="border rounded p-3 mb-3">

                            <strong>{{ $review->name }}</strong>

                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $review->rating ? '⭐' : '☆' }}
                                @endfor
                            </div>

                            <p class="mb-0">{{ $review->comment }}</p>

                        </div>

                    @empty

                        <div class="alert alert-light border">
                            No reviews yet. Be the first to review this course.
                        </div>

                    @endforelse

                    <hr>

                    <form action="{{ route('course.review') }}" method="POST">
                        @csrf

                        <input type="hidden" name="course_id" value="{{ $course->id }}">

                        <input type="text" name="name" class="form-control mb-2"
                               placeholder="Your Name" required>

                        <select name="rating" class="form-select mb-2" style="max-width:200px;" required>
                            <option value="">Select Rating</option>
                            <option value="1">⭐ 1 Star</option>
                            <option value="2">⭐⭐ 2 Stars</option>
                            <option value="3">⭐⭐⭐ 3 Stars</option>
                            <option value="4">⭐⭐⭐⭐ 4 Stars</option>
                            <option value="5">⭐⭐⭐⭐⭐ 5 Stars</option>
                        </select>

                        <textarea name="comment" class="form-control mb-2" rows="3"
                                  placeholder="Write your review here..." required></textarea>

                        <button type="submit" class="btn btn-warning fw-bold">
                            Submit Review
                        </button>

                    </form>

                </div>

            </div>
        </div>

    </div>
</div>


{{-- YOU MAY LIKE SECTION --}}
<div class="container-fluid mt-5 mb-5">
    <h4 class="fw-bold mb-1">YOU MAY LIKE</h4>
    <hr style="width:40px; border:2px solid black; margin-top:0;">

    @if($relatedCourses->count())

        <div class="you-may-like-wrapper position-relative mt-3">

            <div class="you-may-like-slider" id="youMayLikeSlider">

                @foreach($relatedCourses as $rc)

                    @php
                        $rcAvgRating = ($rc->reviews && $rc->reviews->count())
                            ? round($rc->reviews->avg('rating'))
                            : 5;
                    @endphp

                    <div class="slider-card">
                        <a href="{{ url('/courses/'.$rc->slug) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-0">

                                @if($rc->image)
                                    <img src="{{ resolveMediaPath($rc->image, 'image') }}"
                                         class="card-img-top" style="height:180px; object-fit:cover;">
                                @endif

                                <div class="card-body">
                                    <h6 class="fw-bold">{{ $rc->short_title ?? $rc->title }}</h6>
                                    <div class="d-flex align-items-center gap-2 text-muted mt-2">
                                        <img src="https://ui-avatars.com/api/?name=UF&size=30&background=orange&color=fff"
                                             class="rounded-circle" width="30">
                                        <small>Ufadmin</small>
                                        @if($rc->students)
                                            <span class="ms-auto">👥 {{ $rc->students }}</span>
                                        @endif
                                    </div>
                                    <div class="text-warning mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= $rcAvgRating ? '⭐' : '☆' }}
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                @endforeach

            </div>

        </div>

    @else

        <p class="text-muted">No related courses found.</p>

    @endif

</div>

@include('partials.course-show-scripts')
@include('partials.pdf-login-alert-script')

@include('layouts.footer')