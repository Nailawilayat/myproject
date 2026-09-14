@extends('admin.layouts.app')

@section('title', 'Enrolled Students')

@section('page-title', 'Enrolled Students')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid px-0">

    <div class="card border-0 shadow-sm admin-table-card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4 admin-page-header">

                <h5 class="fw-bold mb-0">
                    Enrolled Students
                </h5>

                <span class="badge bg-primary">
                    {{ $students->count() }} Enrolled
                </span>

            </div>


            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif


            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif


            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle admin-table">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Gender</th>
                            <th width="120">Action</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($students as $student)

                            <tr>

                                <td data-label="ID">
                                    {{ $student->id }}
                                </td>

                                <td data-label="Name">
                                    <strong>{{ $student->name }}</strong>
                                </td>

                                <td data-label="Email">
                                    {{ $student->email }}
                                </td>

                                <td data-label="Phone">
                                    {{ $student->phone ?? 'N/A' }}
                                </td>

                                <td data-label="Course">
                                    {{ $student->course ?? 'N/A' }}
                                </td>

                                <td data-label="Gender">
                                    {{ ucfirst($student->gender ?? 'N/A') }}
                                </td>

                                <td data-label="Action">

                                    <form action="{{ route('admin.students.delete', $student->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this student?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center text-muted admin-empty-state">

                                    <i class="bi bi-mortarboard" style="font-size: 40px;"></i>

                                    <h6 class="mt-3">
                                        No enrolled students found.
                                    </h6>

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