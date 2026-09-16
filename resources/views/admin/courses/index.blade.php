@extends('admin.layouts.app')

@section('title', 'Courses')

@section('page-title', 'Courses')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid px-0">

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


    <div class="d-flex justify-content-between align-items-center mb-4 admin-page-header">

        <h5 class="mb-0">
            All Courses
        </h5>

        <a href="{{ route('admin.courses.create') }}"
           class="btn btn-warning">

            <i class="bi bi-plus-circle"></i>
            Add Course

        </a>

    </div>


    <div class="card shadow-sm admin-table-card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle admin-table">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Teacher</th>
                            <th>Duration</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th width="120">Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($courses as $index => $course)

                            <tr>

                                <td data-label="#">
                                    {{ $index + 1 }}
                                </td>


                                <td data-label="Image">
                                    @if($course->image)
                                        <img src="{{ resolveMediaPath($course->image, 'image') }}"
                                             alt="{{ $course->title }}"
                                             width="60"
                                             height="60"
                                             style="object-fit:cover; border-radius:6px;">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>


                                <td data-label="Title">
                                    <strong>
                                        {{ $course->title }}
                                    </strong>
                                </td>


                                <td data-label="Category">
                                    {{ $course->category ?? 'N/A' }}
                                </td>


                                <td data-label="Teacher">
                                    {{ $course->teacher ?? 'N/A' }}
                                </td>


                                <td data-label="Duration">
                                    {{ $course->duration ?? 'N/A' }}
                                </td>


                                <td data-label="Level">
                                    {{ ucfirst($course->level ?? 'N/A') }}
                                </td>


                                <td data-label="Status">

                                    @if($course->status == 1)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                <td data-label="Featured">

                                    @if($course->featured)

                                        <span class="badge bg-warning text-dark">
                                            Yes
                                        </span>

                                    @else

                                        <span class="badge bg-light text-dark">
                                            No
                                        </span>

                                    @endif

                                </td>


                                <td data-label="Action">

                                    <form action="{{ route('admin.courses.delete', $course->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this course?');">

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

                                <td colspan="10"
                                    class="text-center text-muted admin-empty-state">

                                    <i class="bi bi-mortarboard"
                                       style="font-size: 40px;"></i>

                                    <h6 class="mt-3">
                                        No courses found.
                                    </h6>

                                    <a href="{{ route('admin.courses.create') }}"
                                       class="btn btn-warning btn-sm mt-2">

                                        <i class="bi bi-plus-circle"></i>
                                        Add Course

                                    </a>

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