@extends('teacher.layouts.app')

@section('title', 'My Students')
@section('page-title', 'My Students')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <h5 class="fw-bold mb-4">My Students ({{ $students->count() }})</h5>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Gender</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($students as $index => $student)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $student->name }}</strong></td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone ?? 'N/A' }}</td>
                            <td><span class="badge bg-success">{{ $student->course }}</span></td>
                            <td>{{ ucfirst($student->gender ?? 'N/A') }}</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-people" style="font-size: 40px;"></i>
                                <h6 class="mt-3">No students enrolled in your courses yet.</h6>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection