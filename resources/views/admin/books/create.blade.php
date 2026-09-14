@extends('admin.layouts.app')

@section('title', 'Add Book')

@section('page-title', 'Add Book')

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


    <div class="card shadow-sm admin-form-card">

        <div class="card-header">
            <h5 class="mb-0">
                Add New Book
            </h5>
        </div>


        <div class="card-body">

            <form action="{{ route('admin.books.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                <div class="row">


                    {{-- Book Title --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Book Title
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}"
                               placeholder="Enter book title"
                               required>

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Author --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Author
                        </label>

                        <input type="text"
                               name="author"
                               class="form-control @error('author') is-invalid @enderror"
                               value="{{ old('author') }}"
                               placeholder="Enter author name">

                        @error('author')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Category --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Category
                        </label>

                        <input type="text"
                               name="category"
                               class="form-control @error('category') is-invalid @enderror"
                               value="{{ old('category') }}"
                               placeholder="Enter book category">

                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Cover Image --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Cover Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/jpeg,image/png,image/jpg,image/webp">

                        <small class="text-muted">
                            JPG, JPEG, PNG or WEBP
                        </small>

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PDF --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            PDF File
                        </label>

                        <input type="file"
                               name="pdf"
                               class="form-control @error('pdf') is-invalid @enderror"
                               accept="application/pdf">

                        <small class="text-muted">
                            PDF only, maximum 10MB
                        </small>

                        @error('pdf')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="mt-3 admin-form-actions">

                    <button type="submit"
                            class="btn btn-warning">

                        <i class="bi bi-book"></i>
                        Save Book

                    </button>


                    <a href="{{ route('admin.books') }}"
                       class="btn btn-secondary">

                        Cancel

                    </a>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection