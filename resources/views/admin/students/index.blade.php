@extends('admin.layouts.app')

@section('title', 'All Students')

@section('page-title', 'All Students')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                <h5 class="fw-bold mb-0">
                    All Students
                </h5>

                <span class="badge bg-primary">
                    {{ $students->count() }} Students
                </span>

            </div>


            {{-- Success Message --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Error Message --}}
            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show">

                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- ================= DESKTOP / TABLET TABLE VIEW ================= --}}

            <div class="table-responsive d-none d-md-block">

                <table class="table table-bordered table-hover align-middle">

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

                                <td>
                                    {{ $student->id }}
                                </td>


                                <td>
                                    <strong>
                                        {{ $student->name }}
                                    </strong>
                                </td>


                                <td>
                                    {{ $student->email }}
                                </td>


                                <td>
                                    {{ $student->phone ?? 'N/A' }}
                                </td>


                                <td>
                                    {{ $student->course ?? 'N/A' }}
                                </td>


                                <td>
                                    {{ ucfirst($student->gender ?? 'N/A') }}
                                </td>


                                <td>

                                    <form action="{{ route('admin.students.delete', $student->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this student?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger">

                                            <i class="bi bi-trash"></i>
                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center text-muted py-5">

                                    <i class="bi bi-people"
                                       style="font-size: 40px;"></i>

                                    <h6 class="mt-3">
                                        No students found.
                                    </h6>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================= MOBILE CARD VIEW ================= --}}

            <div class="d-md-none">

                @forelse($students as $student)

                    <div class="card mb-3 shadow-sm">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-2">

                                <h6 class="fw-bold mb-0">
                                    {{ $student->name }}
                                </h6>

                                <span class="badge bg-secondary">
                                    ID: {{ $student->id }}
                                </span>

                            </div>

                            <p class="mb-1 small text-muted">
                                <i class="bi bi-envelope me-1"></i>
                                {{ $student->email }}
                            </p>

                            <p class="mb-1 small text-muted">
                                <i class="bi bi-telephone me-1"></i>
                                {{ $student->phone ?? 'N/A' }}
                            </p>

                            <p class="mb-1 small text-muted">
                                <i class="bi bi-book me-1"></i>
                                {{ $student->course ?? 'N/A' }}
                            </p>

                            <p class="mb-3 small text-muted">
                                <i class="bi bi-gender-ambiguous me-1"></i>
                                {{ ucfirst($student->gender ?? 'N/A') }}
                            </p>

                            <form action="{{ route('admin.students.delete', $student->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this student?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger w-100">

                                    <i class="bi bi-trash"></i>
                                    Delete

                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="text-center text-muted py-5">

                        <i class="bi bi-people"
                           style="font-size: 40px;"></i>

                        <h6 class="mt-3">
                            No students found.
                        </h6>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection