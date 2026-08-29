@include('layouts.header')

<link rel="stylesheet" href="{{ asset('css/books.css') }}">

{{-- ==================== BOOKS BANNER ==================== --}}
<section class="page-banner">
    <div class="overlay"></div>
    <div class="container text-center content">
        <h1 class="banner-title">Our Books</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Books</li>
            </ol>
        </nav>
    </div>
</section>

{{-- ==================== BOOKS LISTING SECTION ==================== --}}
<section class="books-page py-5">
    <div class="container">
        <div class="row gy-5">

            {{-- ---------------- BOOK CARDS ---------------- --}}
            <div class="col-lg-8">
                <div class="row g-4">
                    @forelse ($books as $book)
                        <div class="col-md-6">
                            <div class="book-card h-100">
                                <div class="book-card-img">
                                    <img src="{{ asset('images/'.$book->image) }}" alt="{{ $book->title }}">
                                </div>
                                <div class="book-card-content">
                                    <h5 class="book-card-title">{{ $book->title }}</h5>
                                    <a href="{{ route('books.show', $book->slug) }}" class="book-read-btn">
                                        View Book <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-muted">No books available.</p>
                        </div>
                    @endforelse
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
                @if (count($books))
                    <div class="sidebar-widget mb-4">
                        <h6 class="widget-title">RECENT BOOKS</h6>
                        @foreach (collect($books)->take(3) as $recent)
                            <div class="blog-item d-flex mb-3">
                                <img src="{{ asset('images/'.$recent->image) }}" width="70" height="70" style="object-fit:cover; border-radius:8px;">
                                <div class="ms-3">
                                    <h6 class="mb-1"><a href="{{ route('books.show', $recent->slug) }}" class="recent-post-link">{{ Str::limit($recent->title, 40) }}</a></h6>
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

@include('layouts.footer')