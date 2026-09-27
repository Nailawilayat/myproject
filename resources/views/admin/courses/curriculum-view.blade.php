@extends('admin.layouts.app')

@section('title', 'Curriculum - ' . $course->title)
@section('page-title', 'Curriculum')

@section('content')

<div class="container-fluid px-0">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="mb-0">
            Curriculum — <span class="text-warning">{{ $course->title }}</span>
        </h5>

        <a href="{{ route('admin.courses') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back to Courses
        </a>
    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            @if($lessons->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Lesson Title</th>
                                <th>PDF</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($lessons as $index => $lesson)

                                <tr>

                                    <td>{{ $index + 1 }}</td>

                                    <td><strong>{{ $lesson->title }}</strong></td>

                                    <td>
                                        @if($lesson->pdf)
                                            <a href="{{ asset('storage/' . $lesson->pdf) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-danger">
                                                <i class="bi bi-file-earmark-pdf"></i> View PDF
                                            </a>
                                        @else
                                            <span class="text-muted">No PDF</span>
                                        @endif
                                    </td>

                                    <td>
                                        <form action="{{ route('admin.courses.lessons.delete', $lesson->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this lesson?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center text-muted py-5">
                    <i class="bi bi-journal-x" style="font-size:40px;"></i>
                    <h6 class="mt-3">No lessons added for this course yet.</h6>
                </div>

            @endif

        </div>

    </div>

</div>

@endsection