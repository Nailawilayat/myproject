@include('layouts.header')

@php
    // ---------------------------------------------------------
    // Replace this whole block with real data from your controller:
    // e.g. controller does: $post = Post::where('slug', $slug)->firstOrFail();
    //      $related = Post::where('category', $post->category)
    //                      ->where('id', '!=', $post->id)->take(3)->get();
    // and just passes $post / $related to the view.
    // ---------------------------------------------------------
    $allPosts = $allPosts ?? [
        ['title' => 'Learn Quran Easily With Proper Tajweed', 'image' => 'blog1.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Tajweed', 'excerpt' => 'Discover simple and effective methods to learn the Holy Quran with correct pronunciation and Tajweed rules, guided by certified tutors.', 'slug' => 'learn-quran-easily'],
        ['title' => 'Islamic Parenting Tips For Modern Families', 'image' => 'blog2.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Parenting', 'excerpt' => 'Raising children with strong Islamic values in today\'s world can be challenging. Here are practical tips every Muslim parent should know.', 'slug' => 'islamic-parenting-tips'],
        ['title' => 'How Our Teachers Guide Every Student', 'image' => 'blog3.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Teaching', 'excerpt' => 'Our certified Quran tutors follow a step-by-step guidance approach to ensure every student, young or old, learns at their own pace.', 'slug' => 'teacher-guidance'],
        ['title' => 'Benefits Of Learning Quran Online', 'image' => 'blog1.jpg', 'author' => 'Admin', 'date' => 'Feb 05, 2022', 'category' => 'Online Learning', 'excerpt' => 'From flexible timing to one-on-one attention, online Quran learning offers many advantages for busy families around the world.', 'slug' => 'benefits-online-quran'],
        ['title' => 'Common Mistakes Beginners Make In Tajweed', 'image' => 'blog2.jpg', 'author' => 'Admin', 'date' => 'Feb 12, 2022', 'category' => 'Tajweed', 'excerpt' => 'New students often repeat the same Tajweed mistakes. Here is how our teachers help correct them early on.', 'slug' => 'tajweed-mistakes'],
        ['title' => 'How To Keep Kids Motivated During Online Classes', 'image' => 'blog3.jpg', 'author' => 'Admin', 'date' => 'Feb 18, 2022', 'category' => 'Parenting', 'excerpt' => 'Keeping children focused during online Quran classes needs the right balance of routine, encouragement, and fun.', 'slug' => 'keep-kids-motivated'],
        ['title' => 'A Day In The Life Of Our Online Tutors', 'image' => 'blog1.jpg', 'author' => 'Admin', 'date' => 'Feb 25, 2022', 'category' => 'Teaching', 'excerpt' => 'Ever wondered how our tutors prepare for classes? Here is a behind-the-scenes look at their daily routine.', 'slug' => 'day-in-life-tutors'],
        ['title' => 'Why Online Quran Learning Works For Busy Adults', 'image' => 'blog2.jpg', 'author' => 'Admin', 'date' => 'Mar 03, 2022', 'category' => 'Online Learning', 'excerpt' => 'Adults with busy schedules can still learn the Quran properly thanks to flexible online class timings.', 'slug' => 'online-learning-busy-adults'],
        ['title' => 'Basic Masalah Every Muslim Should Know', 'image' => 'blog3.jpg', 'author' => 'Admin', 'date' => 'Mar 10, 2022', 'category' => 'Basic Masalah', 'excerpt' => 'A simple guide covering the essential everyday masalah every practicing Muslim family should be aware of.', 'slug' => 'basic-masalah-guide'],
    ];

    // find current post by slug (route parameter), fallback to first post
    $currentSlug = $slug ?? request()->route('slug');
    $post = $post ?? collect($allPosts)->firstWhere('slug', $currentSlug) ?? $allPosts[0];

    // related posts = same category, excluding current, max 3
    $related = $related ?? collect($allPosts)
        ->where('category', $post['category'])
        ->where('slug', '!=', $post['slug'])
        ->take(3)
        ->values();

    // if not enough same-category posts, fill up with other recent posts
    if ($related->count() < 3) {
        $fill = collect($allPosts)
            ->where('slug', '!=', $post['slug'])
            ->whereNotIn('slug', $related->pluck('slug'))
            ->take(3 - $related->count());
        $related = $related->merge($fill)->values();
    }
@endphp

{{-- ==================== BLOG DETAIL BANNER ==================== --}}
<section class="page-banner">
    <div class="overlay"></div>
    <div class="container text-center content">
        <h1 class="banner-title">{{ $post['title'] }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-white">Blog</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($post['title'], 40) }}</li>
            </ol>
        </nav>
    </div>
</section>

{{-- ==================== BLOG DETAIL SECTION ==================== --}}
<section class="blog-page py-5">
    <div class="container">
        <div class="row gy-5">

            {{-- ---------------- MAIN ARTICLE ---------------- --}}
            <div class="col-lg-8">

                <div class="blog-detail-card">
                    <div class="blog-detail-img">
                        <img src="{{ asset('images/'.$post['image']) }}" alt="{{ $post['title'] }}">
                        <span class="blog-cat-badge">{{ $post['category'] }}</span>
                    </div>

                    <div class="blog-detail-content">
                        <div class="blog-meta mb-2">
                            <span><i class="bi bi-person-fill"></i> {{ $post['author'] }}</span>
                            <span><i class="bi bi-calendar-event"></i> {{ $post['date'] }}</span>
                            <span><i class="bi bi-folder"></i> {{ $post['category'] }}</span>
                        </div>

                        <h2 class="blog-detail-title">{{ $post['title'] }}</h2>

                        <p class="blog-detail-text">{{ $post['excerpt'] }}</p>

                        {{-- Replace this placeholder paragraph with $post->body (full article HTML) --}}
                       <p class="blog-detail-text">
                         {{ $post['excerpt'] }}
                           </p>

            <p class="blog-detail-text">
             Online Quran learning has transformed the way Muslims around the world connect
            with the Holy Quran. With qualified teachers, flexible timings, and one-to-one
          classes, students of all ages can now learn from the comfort of their homes.
             Sultana Quran Academy provides the best online Quran education for kids and adults.
            </p>

                        

                        {{-- SHARE --}}
                        <div class="blog-share mt-4">
                            <span class="me-2 fw-bold">Share:</span>
                            <a href="#" class="share-icon"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="share-icon"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="share-icon"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="share-icon"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                {{-- ---------------- RELATED BLOGS ---------------- --}}
                @if ($related->count())
                    <div class="related-posts mt-5">
                        <h4 class="related-title mb-4">Related Blogs</h4>
                        <div class="row g-4">
                            @foreach ($related as $rel)
                                <div class="col-md-4">
                                    <div class="related-card">
                                        <div class="related-img">
                                            <img src="{{ asset('images/'.$rel['image']) }}" alt="{{ $rel['title'] }}">
                                            <span class="blog-cat-badge small">{{ $rel['category'] }}</span>
                                        </div>
                                        <div class="related-content">
                                            <small class="text-muted">{{ $rel['date'] }}</small>
                                            <h6 class="related-post-title">
                                                <a href="{{ route('blog.show', $rel['slug']) }}">{{ Str::limit($rel['title'], 45) }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            {{-- ---------------- SIDEBAR ---------------- --}}
            <div class="col-lg-4">

                {{-- SEARCH --}}
                <div class="sidebar-widget mb-4">
                    <h6 class="widget-title">SEARCH</h6>
                    <form action="{{ route('blog.search') }}" method="GET" class="search-form">
                        <input type="text" name="q" class="form-control" placeholder="Search articles...">
                        <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                {{-- RECENT POSTS --}}
                <div class="sidebar-widget mb-4">
                    <h6 class="widget-title">RECENT POSTS</h6>
                    @foreach (array_slice($allPosts, 0, 3) as $recent)
                        <div class="blog-item d-flex mb-3">
                            <img src="{{ asset('images/'.$recent['image']) }}" width="70" height="70" style="object-fit:cover; border-radius:8px;">
                            <div class="ms-3">
                                <h6 class="mb-1"><a href="{{ route('blog.show', $recent['slug']) }}" class="recent-post-link">{{ Str::limit($recent['title'], 40) }}</a></h6>
                                <small>{{ $recent['date'] }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>

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
