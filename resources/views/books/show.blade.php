@include('layouts.header')

<link rel="stylesheet" href="{{ asset('css/books.css') }}">

@php
    function resolveBookPath($path, $type) {
        if (empty($path)) return null;

        if (str_starts_with($path, 'books/')) {
            return asset('storage/' . $path);
        }

        return $type === 'pdf'
            ? asset('pdfs/' . $path)
            : asset('images/' . $path);
    }
@endphp

{{-- ==================== BOOK DETAIL BANNER ==================== --}}
<section class="page-banner">
    <div class="overlay"></div>
    <div class="container text-center content">
        <h1 class="banner-title">{{ $book->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('books.index') }}" class="text-white">Books</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($book->title, 40) }}</li>
            </ol>
        </nav>
    </div>
</section>

{{-- ==================== BOOK READER SECTION ==================== --}}
<section class="books-page py-5">
    <div class="container">
        <div class="row gy-5">

            {{-- ---------------- BOOK READER ---------------- --}}
            <div class="col-lg-8">

                <div class="book-container">

                    {{-- PDF CAROUSEL --}}
                    <div id="pdfCarousel" class="carousel slide pdf-carousel" data-bs-ride="false" data-bs-interval="false">

                        <div class="carousel-inner" id="pdf-slider">
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#pdfCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#pdfCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>

                    </div>

                    {{-- BACK BUTTON --}}
                    <div class="mt-4">
                        <a href="{{ route('books.index') }}" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back to Books
                        </a>
                    </div>

                </div>

            </div>

            {{-- ---------------- SIDEBAR ---------------- --}}
            <div class="col-lg-4">

                {{-- SEARCH --}}
                <div class="sidebar-widget mb-4">
                    <h6 class="widget-title">SEARCH</h6>
                    <form action="{{ route('books.search') }}" method="GET" class="search-form">
                        <input type="text" name="q" class="form-control" placeholder="Search books...">
                        <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                {{-- RECENT BOOKS --}}
                @if (isset($allBooks) && $allBooks->count() > 0)
                    <div class="sidebar-widget mb-4">
                        <h6 class="widget-title">RECENT BOOKS</h6>
                        @foreach ($allBooks->take(3) as $recent)
                            <div class="blog-item d-flex mb-3">
                                <img src="{{ resolveBookPath($recent->image, 'image') }}"
                                     width="70" height="70"
                                     style="object-fit:cover; border-radius:8px;"
                                     alt="{{ $recent->title }}">
                                <div class="ms-3">
                                    <h6 class="mb-1">
                                        <a href="{{ route('books.show', $recent->slug) }}" class="recent-post-link">
                                            {{ Str::limit($recent->title, 40) }}
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- CATEGORIES --}}
                <div class="sidebar-widget mb-4">
                    <h6 class="widget-title">CATEGORIES</h6>
                    <ul class="category-list">
                        <li><a href="#">Tajweed <span>(8)</span></a></li>
                        <li><a href="#">Parenting <span>(5)</span></a></li>
                        <li><a href="#">Teaching <span>(6)</span></a></li>
                        <li><a href="#">Online Learning <span>(4)</span></a></li>
                        <li><a href="#">Basic Masalah <span>(3)</span></a></li>
                    </ul>
                </div>

                {{-- CALL TO ACTION --}}
                <div class="sidebar-widget cta-widget text-center">
                    <h6 class="mb-3">Want To Learn Quran Online?</h6>
                    <p>Book your free trial class with our certified teachers today.</p>
                    <a href="{{ route('register') }}" class="price-btn">APPLY NOW</a>
                </div>

            </div>

        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
@include('partials.pdf-reader-scripts')

<script>
    initPdfReader("{{ resolveBookPath($book->pdf, 'pdf') }}");
</script>

@include('layouts.footer')