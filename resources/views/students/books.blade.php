@extends('student.layouts.app')

@section('title', 'Books')
@section('page-title', 'Books')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <h5 class="fw-bold mb-4">Library ({{ $books->count() }} Books)</h5>

        <div class="row g-4">

            @forelse($books as $book)

                @php
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

                <div class="col-md-3 col-6">

                    <div class="card border-0 shadow-sm h-100 stat-card">

                        @if($imageUrl)
                            <img src="{{ $imageUrl }}"
                                 alt="{{ $book->title }}"
                                 class="card-img-top"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                 style="height: 200px;">
                                <i class="bi bi-book" style="font-size: 40px; color: #ccc;"></i>
                            </div>
                        @endif

                        <div class="card-body">

                            <h6 class="fw-bold mb-1">{{ $book->title }}</h6>
                            <small class="text-muted d-block mb-2">
                                {{ $book->author ?? 'Unknown Author' }}
                            </small>

                            @if($pdfUrl)
                                <a href="{{ $pdfUrl }}"
                                   target="_blank"
                                   class="btn btn-sm btn-warning w-100">
                                    <i class="bi bi-file-pdf"></i>
                                    Read PDF
                                </a>
                            @else
                                <span class="text-muted small">No PDF available</span>
                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-journal-bookmark" style="font-size: 40px;"></i>
                        <h6 class="mt-3">No books available yet.</h6>
                    </div>
                </div>

            @endforelse

        </div>

    </div>
</div>

@endsection