@extends('teacher.layouts.app')

@section('title', 'My Courses')
@section('page-title', 'My Courses')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <h5 class="fw-bold mb-4">My Courses ({{ $courses->count() }})</h5>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Duration</th>
                        <th>Level</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($courses as $index => $course)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $course->title }}</strong></td>
                            <td>{{ $course->category ?? 'N/A' }}</td>
                            <td>{{ $course->duration ?? 'N/A' }}</td>
                            <td>{{ ucfirst($course->level ?? 'N/A') }}</td>
                            <td>
                                @if($course->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-book" style="font-size: 40px;"></i>
                                <h6 class="mt-3">No courses assigned to you yet.</h6>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection