@extends('admin.layouts.app')

@section('title', 'Add Teacher')

@section('page-title', 'Add Teacher')

@push('styles')

<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">

@endpush

@section('content')

<div class="container-fluid px-0">

    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Teacher Form Card --}}
    <div class="card shadow-sm admin-form-card">

        {{-- Card Header --}}
        <div class="card-header">

            <h5 class="mb-0">
                Add New Teacher
            </h5>

        </div>


        {{-- Card Body --}}
        <div class="card-body">

            <form
                action="{{ route('admin.teachers.store') }}"
                method="POST"
            >

                @csrf


                {{-- Account Details --}}
                <h6 class="fw-bold mb-3 text-muted">
                    Account Details
                </h6>


                <div class="row">

                    {{-- Teacher Name --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Teacher Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            required
                        >

                        @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            required
                        >

                        @error('email')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Password --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            required
                        >

                        @error('password')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required
                        >

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="mt-3 admin-form-actions">

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >

                        <i class="bi bi-person-plus"></i>

                        Save Teacher

                    </button>


                    <a
                        href="{{ route('admin.teachers') }}"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection