@extends('admin.layouts.app')

@section('title', 'Teachers')

@section('page-title', 'Teachers')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid teachers-page px-2 px-sm-3 px-md-4">

    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            <i class="bi bi-exclamation-triangle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Page Header --}}
    <div class="teachers-header">

        <div class="teachers-heading">

            <h5 class="mb-1 fw-bold">
                All Teachers
            </h5>

            <small class="text-muted">
                Manage all teachers from here
            </small>

        </div>


        <a href="{{ route('admin.teachers.create') }}"
           class="btn btn-warning add-teacher-btn">

            <i class="bi bi-plus-circle me-1"></i>

            Add Teacher

        </a>

    </div>


    {{-- Teachers Card --}}
    <div class="card border-0 shadow-sm teachers-card">

        <div class="card-body p-2 p-sm-3 p-md-4">

            <div class="table-responsive teachers-table-wrapper">

                <table class="table table-bordered table-hover align-middle mb-0 teachers-table">

                    <thead class="table-dark">

                        <tr>

                            <th class="number-column">
                                #
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Joined On
                            </th>

                            <th class="action-column">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($teachers as $index => $teacher)

                            <tr>

                                {{-- Number --}}
                                <td>
                                    {{ $index + 1 }}
                                </td>


                                {{-- Name --}}
                                <td>

                                    <div class="teacher-name-wrapper">

                                        <div class="teacher-icon">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <strong>
                                            {{ $teacher->name }}
                                        </strong>

                                    </div>

                                </td>


                                {{-- Email --}}
                                <td>

                                    <span class="teacher-email">
                                        {{ $teacher->email }}
                                    </span>

                                </td>


                                {{-- Joined --}}
                                <td>

                                    @if($teacher->created_at)

                                        {{ \Carbon\Carbon::parse($teacher->created_at)->format('d M Y') }}

                                    @else

                                        <span class="text-muted">
                                            N/A
                                        </span>

                                    @endif

                                </td>


                                {{-- Action --}}
                                <td>

                                    <form
                                        action="{{ route('admin.teachers.delete', $teacher->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this teacher?');"
                                        class="teacher-delete-form"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger delete-teacher-btn">

                                            <i class="bi bi-trash me-1"></i>

                                            <span>Delete</span>

                                        </button>

                                    </form>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center text-muted no-teachers">

                                    <i class="bi bi-person-video3 no-teachers-icon"></i>

                                    <h6 class="mt-3 fw-bold">
                                        No teachers found.
                                    </h6>

                                    <p class="mb-3">
                                        No teacher accounts have been added yet.
                                    </p>

                                    <a href="{{ route('admin.teachers.create') }}"
                                       class="btn btn-warning btn-sm">

                                        <i class="bi bi-plus-circle me-1"></i>

                                        Add Teacher

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