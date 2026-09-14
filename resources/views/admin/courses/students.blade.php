@extends('admin.layouts.app')

@section('title', 'Enrolled Students')

@section('page-title', 'Enrolled Students')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4 admin-page-header">

        <h5 class="fw-bold mb-0">
            Students Enrolled in Courses
        </h5>

        <span class="badge bg-primary">
            {{ $students->count() }} Total
        </span>

    </div>


    <div class="card border-0 shadow-sm admin-table-card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle admin-table">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Enrolled Course</th>
                            <th>Gender</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($students as $student)

                            <tr>

                                <td data-label="ID">{{ $student->id }}</td>

                                <td data-label="Name">
                                    <strong>{{ $student->name }}</strong>
                                </td>

                                <td data-label="Email">{{ $student->email }}</td>

                                <td data-label="Phone">{{ $student->phone ?? 'N/A' }}</td>

                                <td data-label="Enrolled Course">
                                    <span class="badge bg-success">{{ $student->course }}</span>
                                </td>

                                <td data-label="Gender">{{ ucfirst($student->gender ?? 'N/A') }}</td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted admin-empty-state">
                                    <i class="bi bi-mortarboard" style="font-size: 40px;"></i>
                                    <h6 class="mt-3">No enrolled students found.</h6>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection