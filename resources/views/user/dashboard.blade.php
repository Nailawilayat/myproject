@include('layouts.header')

<div class="container py-5">

    <div class="text-center mb-5">

        <h1 class="fw-bold">
            User Dashboard
        </h1>

        <p class="text-muted">
            Welcome, {{ $userName }}
        </p>

    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4>Books</h4>

                    <a href="{{ route('books.index') }}"
                       class="btn btn-primary">
                        View Books
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4>Courses</h4>

                    <a href="{{ route('courses.index') }}"
                       class="btn btn-success">
                        View Courses
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>