@include('layouts.header')
@include('layouts.hero')

<section class="py-5" style="background:#f8f9fa;">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:#b98181;">OUR BLOG</h2>
            <p class="text-muted">Islamic knowledge, Quran tips and academy updates</p>
        </div>

        <div class="row g-4">

            {{-- LEFT - BLOG POSTS --}}
            <div class="col-lg-8">

                @php
                $allPosts = $allPosts ?? [];
                @endphp

                @forelse($allPosts as $post)
                <div class="blog-card mb-4">
                    <div class="blog-card-img">
                        <img src="{{ asset('images/'.$post['image']) }}"
                             alt=""
                             onerror="this.src='{{ asset('images/hero1.jpg') }}'">
                        <span class="blog-category">{{ $post['category'] }}</span>
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-meta">
                            <span><i class="bi bi-person-fill"></i> {{ $post['author'] }}</span>
                            <span><i class="bi bi-calendar3"></i> {{ $post['date'] }}</span>
                        </div>
                        <h4 class="blog-title">{{ $post['title'] }}</h4>
                        <p class="blog-excerpt">{{ $post['excerpt'] }}</p>
                        <a href="{{ route('blog.show', $post['slug']) }}" class="blog-read-btn">
                            READ MORE ➜
                        </a>
                    </div>
                </div>
                @empty
                    <p class="text-muted text-center">No blog posts yet.</p>
                @endforelse

            </div>

            {{-- RIGHT - SIDEBAR --}}
            <div class="col-lg-4">

                {{-- SEARCH --}}
                <div class="sidebar-widget mb-4">
                    <h5 class="sidebar-title">Search</h5>
                    <form action="{{ route('blog.search') }}" method="GET" class="d-flex">
                        <input type="text" name="q" class="form-control" placeholder="Search blog...">
                        <button class="btn ms-2" style="background:orange; color:#fff; border-radius:6px;">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>

                {{-- RECENT POSTS --}}
                <div class="sidebar-widget mb-4">
                    <h5 class="sidebar-title">Recent Posts</h5>
                    @foreach(array_slice($allPosts, 0, 3) as $recent)
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/'.$recent['image']) }}"
                             width="70" height="60"
                             style="object-fit:cover; border-radius:6px; flex-shrink:0;"
                             class="me-3"
                             onerror="this.src='{{ asset('images/hero1.jpg') }}'">
                        <div>
                            <a href="{{ route('blog.show', $recent['slug']) }}"
                               style="font-size:14px; font-weight:600; color:#1a1a1a; text-decoration:none; line-height:1.4; display:block;">
                                {{ Str::limit($recent['title'], 40) }}
                            </a>
                            <small class="text-muted">{{ $recent['date'] }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- CATEGORIES --}}
                <div class="sidebar-widget mb-4">
                    <h5 class="sidebar-title">Categories</h5>
                    <ul class="category-list">
                        <li><a href="#">Tajweed       <span>3</span></a></li>
                        <li><a href="#">Parenting     <span>2</span></a></li>
                        <li><a href="#">Teaching      <span>2</span></a></li>
                        <li><a href="#">Online Learning <span>2</span></a></li>
                        <li><a href="#">Basic Masalah <span>1</span></a></li>
                    </ul>
                </div>

                {{-- CTA --}}
                <div class="sidebar-widget text-center"
                     style="background:linear-gradient(135deg,#0a1628,#1565C0);">
                    <h5 style="color:#fff; font-weight:700;">Book a Free Trial Class</h5>
                    <p style="font-size:13px; color:#ccc; margin-bottom:0;">
                        Learn Quran with expert teachers.
                    </p>
                    <a href="{{ route('register') }}"
                       class="d-inline-block px-4 py-2 mt-3 fw-bold text-white rounded-pill"
                       style="background:orange; text-decoration:none;">
                        REGISTER NOW
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

@include('layouts.footer')

