@extends('admin.layouts.app')

@section('title', 'Certificates')

@section('page-title', 'Certificates')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">
@endpush

@section('content')

<div class="container-fluid px-0">

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

    <div class="d-flex justify-content-between align-items-center mb-4 admin-page-header">
        <h5 class="mb-0">Certificates</h5>
    </div>


    {{-- Upload Form --}}
    <div class="card shadow-sm admin-form-card mb-4">

        <div class="card-header">
            <h6 class="mb-0">Add New Certificate</h6>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<form action="{{ route('admin.certificates.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Certificate Title</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Certificate Image</label>
                        <input type="file" name="image" class="form-control"
                               accept="image/jpeg,image/png,image/jpg,image/webp" required>
                    </div>

                </div>

                <div class="admin-form-actions">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-upload"></i>
                        Upload Certificate
                    </button>
                </div>

            </form>

        </div>

    </div>


    {{-- Certificates Grid --}}
    <div class="row g-3">

        @forelse($certificates as $certificate)

            <div class="col-md-4 col-6">

                <div class="card border-0 shadow-sm h-100">

                    <img src="{{ asset($certificate->image) }}"
                         alt="{{ $certificate->title }}"
                         class="card-img-top"
                         style="height: 180px; object-fit: cover;">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <strong style="font-size: 14px;">{{ $certificate->title }}</strong>

                       <form action="{{ route('admin.certificates.delete', $certificate->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this certificate?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center admin-empty-state">
                        <i class="bi bi-patch-check" style="font-size: 40px; color: #ccc;"></i>
                        <h6 class="mt-3">No certificates uploaded yet.</h6>
                    </div>
                </div>
            </div>

        @endforelse

    </div>

</div>

@endsection