@extends('admin.layouts.app')

@section('title', 'Add Course')
@section('page-title', 'Add Course')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid px-0">

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
            <h5 class="mb-0">Add New Course</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h6 class="fw-bold mb-3 text-muted">Course Details</h6>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Title</label>
                        <input type="text" name="short_title" class="form-control"
                               value="{{ old('short_title') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control"
                               value="{{ old('category') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" name="duration" class="form-control"
                               placeholder="e.g. 6 Months" value="{{ old('duration') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Level</label>
                        <select name="level" class="form-select">
                            <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Language</label>
                        <input type="text" name="language" class="form-control"
                               value="{{ old('language') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course Image</label>
                        <input type="file" name="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/*">
                        <small class="text-muted">Recommended size: 800x600px. Max 2MB.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Overview</label>
                        <textarea name="overview" class="form-control" rows="4">{{ old('overview') }}</textarea>
                    </div>

                </div>

                <div class="col-12">
                    <hr class="my-4">
                </div>

                <h6 class="fw-bold mb-3 text-muted">Teacher Details</h6>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Teacher Name</label>
                        <input type="text" name="teacher" class="form-control"
                               value="{{ old('teacher') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Teacher Designation</label>
                        <input type="text" name="teacher_designation" class="form-control"
                               value="{{ old('teacher_designation') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Teacher Image</label>
                        <input type="file" name="teacher_image"
                               class="form-control @error('teacher_image') is-invalid @enderror"
                               accept="image/*">
                        @error('teacher_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Teacher Bio</label>
                        <input type="text" name="teacher_bio" class="form-control"
                               value="{{ old('teacher_bio') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check mt-2">
                            <input type="checkbox" name="featured" value="1" class="form-check-input"
                                   id="featured" {{ old('featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">
                                Mark as Featured
                            </label>
                        </div>
                    </div>

                </div>

                <div class="mt-3 admin-form-actions">

                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-book"></i>
                        Save Course
                    </button>

                    <a href="{{ route('admin.courses') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection