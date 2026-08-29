@include('layouts.header')
@include('layouts.hero')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@php
    // Master list of all course pages available in the app.
    // Update 'slug' values here if your actual routes/slugs differ.
    $staticCourses = collect([
        ['title' => 'Learn Basic Islamic Education',  'slug' => 'basic_islamic',        'image' => 'images/islamic-education.jpg', 'students' => 1],
        ['title' => 'Beginner Quran Course',           'slug' => 'beginner',             'image' => 'images/beginner.jpg',          'students' => 120],
        ['title' => 'Reading the Holy Quran - Juz 30', 'slug' => 'juz30',                'image' => 'images/quran.jpg',             'students' => 150],
        ['title' => 'Quran Reading Course',            'slug' => 'quran-reading-course', 'image' => 'images/quran-reading.jpg',     'students' => 280],
        ['title' => 'Learn Tajweed Online',            'slug' => 'tajweed',              'image' => 'images/user1.jpg',             'students' => 273],
        ['title' => 'Tarjuma-tul-Quran Course',        'slug' => 'tarjuma',              'image' => 'images/quran1.jpg',            'students' => 95],
    ])->reject(fn($c) => $c['slug'] === ($course->slug ?? null));

    // Popular Courses widget: keep only the top 3 most popular courses.
    $allPopularCourses = collect($popularCourses ?? [])->take(3);

    // Merge dynamic Related Courses (from DB) with any static courses not already in that list.
    $relatedExistingSlugs = collect($relatedCourses ?? [])->pluck('slug')->toArray();
    $relatedExtra         = $staticCourses->reject(fn($c) => in_array($c['slug'], $relatedExistingSlugs));
    $allYouMayLike         = collect($relatedCourses ?? [])->concat($relatedExtra);
@endphp

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
                        {{ $course->teacher }}
                    </div>

                    <div>
                        <strong>Category</strong><br>
                        {{ $course->category }}
                    </div>

                    <div>
                        <strong>Review</strong><br>
                        ⭐⭐⭐⭐⭐
                    </div>
                </div>

                <!-- Main Image -->
                <img src="{{ asset($course->image) }}"
     class="img-fluid rounded shadow w-100"
     alt="{{ $course->title }}">

            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-lg-4">

            {{-- POPULAR COURSES --}}
            <div class="sidebar-widget mb-4">
                <h6 class="widget-title">POPULAR COURSES</h6>

                @forelse($allPopularCourses as $pc)

                    @php
                        $pcIsModel    = is_object($pc);
                        $pcTitle      = $pcIsModel ? ($pc->short_title ?? $pc->title) : $pc['title'];
                        $pcSlug       = $pcIsModel ? $pc->slug : $pc['slug'];
                        $pcImage      = $pcIsModel ? asset($pc->image) : asset($pc['image']);
                        $pcAvgRating  = ($pcIsModel && $pc->reviews->count()) ? round($pc->reviews->avg('rating')) : 5;
                    @endphp

                    <a href="{{ url('/courses/'.$pcSlug) }}" class="text-decoration-none text-dark">
                        <div class="blog-item d-flex mb-3">
                            <img src="{{ $pcImage }}"
                                 width="70"
                                 height="70"
                                 style="object-fit:cover;"
                                 class="me-3 rounded flex-shrink-0">

                            <div class="ms-1">
                                <h6 class="mb-1 recent-post-link">{{ $pcTitle }}</h6>
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

            {{-- COURSE FEATURES - directly below Popular Courses --}}
            <div class="sidebar-widget mb-4">
                <h6 class="widget-title">COURSE FEATURES</h6>

                <div class="course-features-box">

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-primary">📄 Lectures</span>
                        <strong>{{ $course->lectures }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-danger">🧩 Quizzes</span>
                        <strong>{{ $course->quizzes }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-warning">⏱ Duration</span>
                        <strong>{{ $course->duration }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-info">📶 Skill level</span>
                        <strong>{{ $course->level }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-secondary">🌐 Language</span>
                        <strong>{{ $course->language }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-danger">👥 Students</span>
                        <strong>{{ $course->students }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2">
                        <span class="text-success">✅ Assessments</span>
                        <strong>{{ $course->quizzes > 0 ? 'Yes' : 'No' }}</strong>
                    </div>

                </div>

            </div>

           

        </div>
        {{-- col-lg-4 end --}}

    </div>

</div>
{{-- container-fluid position-relative end --}}


{{-- TABS SECTION (full width, sidebar lives above) --}}
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
                    <h3 style="color: orange; font-style: italic;">What is Arabic for Beginners (Noorani Qaida) Course?</h3>

                    <p>The Noorani Qaida is the very first step for learning how to read the Holy Quran correctly. Through this course, students become familiar with the Arabic alphabet along with Harakaat, Tanween, Sukoon, Shaddah, and other essential rules, and gain the knowledge needed to form words on their own.</p>

                    <p>We have structured our Noorani Qaida in such a way that even a beginner as young as five years old can learn the Arabic alphabet easily and joyfully, while also picking up the basic principles of Tajweed and word formation.</p>

                    <p>In our Noorani Qaida, we use words directly from the Holy Quran — starting with short words and gradually progressing to longer ones — so that reading the Quran becomes easy for students. The goal is that once a student completes Noorani Qaida, they can recite the Quran with confidence.</p>

                    <p><strong>Who is this course for?</strong></p>

                    <p>This course is for those who learned to read the Quran long ago but have forgotten and want to relearn it properly from the beginning, as well as for children who are learning to read the Quran for the very first time.</p>

                    <hr class="my-4">

                    <h4 style="color: orange;">About Noorani Qaida Course:</h4>

                    <p>Noorani Qaida is the first book for kids and elders to understand how to read the Holy Quran properly. It is the basic book for learning correct Arabic pronunciation — you cannot recite the Holy Quran correctly without learning these basic rules first. This course starts with learning the basic Arabic alphabet and is recommended for anyone who does not yet know Arabic and would like to read the Arabic language, the Quran, and the rules of Tajweed.</p>

                    <p><strong>What You Will Learn in the Online Noorani Qaida Course?</strong></p>

                    <ul>
                        <li>One-to-One Noorani Qaida classes at your suitable schedule.</li>
                        <li>Recognition of Arabic letters in their different shapes and sounds.</li>
                        <li>The basic rules of Tajweed.</li>
                        <li>Classes divided into two parts: Arabic letters first, then basic Islamic knowledge.</li>
                        <li>After completing this course, you will know how to read the Quran with proper pronunciation.</li>
                    </ul>
                </div>
{{-- CURRICULUM TAB --}}
<div class="tab-pane fade" id="curriculum">

    <h4 class="fw-bold mb-4">Course Curriculum</h4>

    <div class="accordion custom-accordion" id="curriculumAccordion">

        @forelse($course->curriculum as $item)

            <div class="accordion-item border-0 shadow-sm rounded mb-3 overflow-hidden">

                <h2 class="accordion-header" id="heading{{ $item->id }}">

                    <button
                        class="accordion-button collapsed fw-bold"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#lesson{{ $item->id }}"
                        aria-expanded="false"
                        aria-controls="lesson{{ $item->id }}"
                    >
                        {{ $item->title }}
                    </button>

                </h2>


                <div
                    id="lesson{{ $item->id }}"
                    class="accordion-collapse collapse"
                    data-bs-parent="#curriculumAccordion"
                >

                    <div class="accordion-body">

                        @if($item->pdf_file)

@if(session('student_id'))

    {{-- Logged-in student --}}
    <a
        href="{{ route('lesson.pdf', ['file' => $item->pdf_file]) }}"
        class="btn btn-danger fw-bold"
        target="_blank"
    >
        📄 Open PDF
    </a>

@else

    {{-- Guest --}}
    <a
        href="{{ route('lesson.pdf', ['file' => $item->pdf_file]) }}"
        class="btn btn-danger fw-bold"
        onclick="showPdfLoginAlert(event, this.href)"
    >
        📄 Open PDF
    </a>

@endif



                        @else

                            <p class="text-muted mb-0">
                                No file attached for this lesson.
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <p class="text-muted">
                No curriculum added yet.
            </p>

        @endforelse

    </div>

</div>

                {{-- INSTRUCTOR TAB --}}
                <div class="tab-pane fade" id="instructor">
                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start text-center text-sm-start gap-3 gap-sm-4 mt-3">
                        <img src="https://ui-avatars.com/api/?name=UF+Admin&size=80&background=orange&color=fff"
                             class="rounded-circle" width="80" height="80">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $course->teacher }}</h5>
                            <p class="text-muted mb-1">{{ $course->teacher_designation }}</p>
                            <p>{{ $course->teacher_bio }}</p>
                        </div>
                    </div>
                </div>

                {{-- REVIEWS TAB --}}
                <div class="tab-pane fade" id="reviews">

                    <h5 class="fw-bold mb-3">Student Reviews</h5>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @forelse($course->reviews as $review)

                        <div class="border rounded p-3 mb-3">

                            <strong>{{ $review->name }}</strong>

                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $review->rating ? '⭐' : '☆' }}
                                @endfor
                            </div>

                            <p class="mb-0">
                                {{ $review->comment }}
                            </p>

                        </div>

                    @empty

                        <div class="alert alert-light border">
                            No reviews yet. Be the first to review this course.
                        </div>

                    @endforelse

                    <hr>

                    <form action="{{ route('course.review') }}" method="POST">
                        @csrf

                        <input type="hidden"
                               name="course_id"
                               value="{{ $course->id }}">

                        <input type="text"
                               name="name"
                               class="form-control mb-2"
                               placeholder="Your Name"
                               required>

                        <select name="rating"
                                class="form-select mb-2"
                                style="max-width:200px;"
                                required>

                            <option value="">Select Rating</option>
                            <option value="1">⭐ 1 Star</option>
                            <option value="2">⭐⭐ 2 Stars</option>
                            <option value="3">⭐⭐⭐ 3 Stars</option>
                            <option value="4">⭐⭐⭐⭐ 4 Stars</option>
                            <option value="5">⭐⭐⭐⭐⭐ 5 Stars</option>

                        </select>

                        <textarea name="comment"
                                  class="form-control mb-2"
                                  rows="3"
                                  placeholder="Write your review here..."
                                  required></textarea>

                        <button type="submit" class="btn btn-warning fw-bold w-100 w-sm-auto">
                            Submit Review
                        </button>

                    </form>

                </div>

            </div>
            {{-- tab-content end --}}
        </div>
        {{-- col-12 end --}}

    </div>
    {{-- row end --}}
</div>
{{-- container-fluid mt-5 end --}}

{{-- YOU MAY LIKE SECTION - auto-sliding responsive slider showing ALL courses --}}
<div class="container-fluid mt-5 mb-5">
    <h4 class="fw-bold mb-1">YOU MAY LIKE</h4>
    <hr style="width:40px; border:2px solid black; margin-top:0;">

    @if($allYouMayLike->count())

        <div class="you-may-like-wrapper position-relative mt-3">

            <div class="you-may-like-slider" id="youMayLikeSlider">

                @foreach($allYouMayLike as $rc)

                    @php
                        $rcIsModel   = is_object($rc);
                        $rcTitle     = $rcIsModel ? ($rc->short_title ?? $rc->title) : $rc['title'];
                        $rcSlug      = $rcIsModel ? $rc->slug : $rc['slug'];
                        $rcImage     = $rcIsModel ? asset($rc->image) : asset($rc['image']);
                        $rcStudents  = $rcIsModel ? $rc->students : ($rc['students'] ?? null);
                        $rcAvgRating = ($rcIsModel && $rc->reviews->count()) ? round($rc->reviews->avg('rating')) : 5;
                    @endphp

                    <div class="slider-card">
                        <a href="{{ url('/courses/'.$rcSlug) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="{{ $rcImage }}" class="card-img-top" style="height:180px; object-fit:cover;">
                                <div class="card-body">
                                    <h6 class="fw-bold">{{ $rcTitle }}</h6>
                                    <div class="d-flex align-items-center gap-2 text-muted mt-2">
                                        <img src="https://ui-avatars.com/api/?name=UF&size=30&background=orange&color=fff" class="rounded-circle" width="30">
                                        <small>Ufadmin</small>
                                        @if(!is_null($rcStudents))
                                            <span class="ms-auto">👥 {{ $rcStudents }}</span>
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

<link rel="stylesheet" href="{{ asset('css/course-page.css') }}">
@include('partials.course-show-scripts')      {{-- slider --}}
@include('partials.pdf-login-alert-script')   {{-- login popup --}}

@include('layouts.footer')