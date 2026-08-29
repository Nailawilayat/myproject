@include('layouts.header')

<section class="page-header">
    {{-- DARK OVERLAY --}}
    <div class="page-overlay"></div>

    <div class="container position-relative">

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-wrap">
            <a href="{{ url('/') }}">Home</a>
            <span> &gt; </span>
            <a href="{{ url('/courses') }}">All Courses</a>
        </div>

        {{-- TITLE --}}
        <h1 class="page-title">ALL COURSES</h1>

    </div>
</section>

<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Quran Courses</h2>
            <p class="text-muted">
                Choose the course that best suits your learning journey.
            </p>
        </div>

        <div class="row">

            @foreach($courses as $course)

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="card course-card border-0 shadow-sm h-100">

                    <img src="{{ asset($course->image) }}"
                         class="card-img-top"
                         style="height:260px; object-fit:cover;"
                         alt="{{ $course->title }}">

                    <div class="card-body">

                        <h5 class="fw-bold mb-3">
                            {{ $course->title }}
                        </h5>

                        <!-- Teacher -->
                        <div class="d-flex align-items-center mb-3">

                            <i class="fa fa-user-circle fa-2x text-secondary"></i>

                            <span class="ms-2 fw-semibold">
                                {{ $course->teacher }}
                            </span>

                        </div>

                        <hr>

                        <!-- Rating & Price -->
                        <div class="d-flex justify-content-between align-items-center">

                            <div class="text-warning fs-5">
                                ★★★★★
                            </div>

                            <div class="fw-bold text-success">

                                @if(isset($course->price) && $course->price > 0)
                                    ${{ $course->price }}
                                @else
                                    Free
                                @endif

                            </div>

                        </div>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <a href="{{ url('/courses/'.$course->slug) }}"
                           class="btn btn-warning w-100">

                            View Details

                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>
</section>

@include('layouts.footer')