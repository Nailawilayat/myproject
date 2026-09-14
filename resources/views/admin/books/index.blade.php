@extends('admin.layouts.app')

@section('title', 'Books')

@section('page-title', 'Books')

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

        <h3 class="mb-0">
            Books
        </h3>

        <a href="{{ route('admin.books.create') }}"
           class="btn btn-warning">

            <i class="bi bi-plus-circle"></i>
            Add New Book

        </a>

    </div>


    <div class="card shadow-sm admin-table-card">

        <div class="card-body">

            @if($books->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle admin-table">

                        <thead class="table-dark">

                            <tr>

                                <th>#</th>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>PDF</th>
                                <th>Created</th>
                                <th width="120">Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($books as $book)

                                @php
                                    // Naye uploads "books/..." se shuru hote hain (storage disk),
                                    // purani books sirf filename hoti hain (public/images ya public/pdfs).
                                    $imageUrl = $book->image
                                        ? (str_starts_with($book->image, 'books/')
                                            ? asset('storage/' . $book->image)
                                            : asset('images/' . $book->image))
                                        : null;

                                    $pdfUrl = $book->pdf
                                        ? (str_starts_with($book->pdf, 'books/')
                                            ? asset('storage/' . $book->pdf)
                                            : asset('pdfs/' . $book->pdf))
                                        : null;
                                @endphp

                                <tr>

                                    <td data-label="#">
                                        {{ $loop->iteration }}
                                    </td>


                                    <td data-label="Cover">

                                        @if($imageUrl)

                                            <img
                                                src="{{ $imageUrl }}"
                                                alt="{{ $book->title }}"
                                                width="60"
                                                height="70"
                                                style="object-fit: cover;"
                                                class="rounded"
                                            >

                                        @else

                                            <span class="text-muted">
                                                No Image
                                            </span>

                                        @endif

                                    </td>


                                    <td data-label="Title">
                                        <strong>
                                            {{ $book->title }}
                                        </strong>
                                    </td>


                                    <td data-label="Author">
                                        {{ $book->author ?? 'N/A' }}
                                    </td>


                                    <td data-label="Category">
                                        {{ $book->category ?? 'N/A' }}
                                    </td>


                                    <td data-label="PDF">

                                        @if($pdfUrl)

                                            <a href="{{ $pdfUrl }}"
                                               target="_blank"
                                               class="btn btn-sm btn-danger">

                                                <i class="bi bi-file-pdf"></i>
                                                View PDF

                                            </a>

                                        @else

                                            <span class="text-muted">
                                                No PDF
                                            </span>

                                        @endif

                                    </td>


                                    <td data-label="Created">
                                        {{ \Carbon\Carbon::parse($book->created_at)->format('d M Y') }}
                                    </td>


                                    <td data-label="Action">

                                        <form action="{{ route('admin.books.delete', $book->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this book?');">

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

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center admin-empty-state">

                    <i class="bi bi-book"
                       style="font-size: 50px;"></i>

                    <h5 class="mt-3">
                        No Books Found
                    </h5>

                    <p class="text-muted">
                        You have not added any books yet.
                    </p>

                    <a href="{{ route('admin.books.create') }}"
                       class="btn btn-warning">

                        <i class="bi bi-plus-circle"></i>
                        Add First Book

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection