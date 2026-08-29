@include('layouts.header')
@include('partials.clock-modal-scripts')
<!-- HERO CAROUSEL -->
<!-- HERO SECTION -->
<section class="hero">
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="false">

    <div class="carousel-inner">

        <!-- SLIDE 1 -->
        <div class="carousel-item active">
            <div class="hero-slide" style="background: url('{{ asset('images/hero1.jpg') }}') center/cover no-repeat;">
                <div class="overlay"></div>
                <div class="hero-content">
    <h2 class="fade-up">Welcome to</h2>
    <h1 class="fade-left">Sultana Quran Academy</h1>
    <h1 class="orange fade-right">ONLINE ACADEMY</h1>
    <p class="fade-up">Want to Learn Quran online with expert, Certified Teachers?</p>
    <a href="#" class="btn-custom fade-up">➜ Book A Free Trial Class</a>
</div>
            </div>
        </div>

        <!-- SLIDE 2 -->
        <div class="carousel-item">
            <div class="hero-slide" style="background: url('{{ asset('images/hero2.jpg') }}') center/cover no-repeat;">
                <div class="overlay"></div>
                <div class="hero-content">
    <h2 class="fade-up">Start Your Journey</h2>
    <h1 class="fade-left">LEARN QURAN</h1>
    <h1 class="orange fade-right">WITH TAJWEED</h1>
    <p class="fade-up">Certified teachers available 24/7</p>
    <a href="#" class="btn-custom fade-up">➜ Join Now</a>
</div>
            </div>
        </div>

        <!-- SLIDE 3 -->
        <div class="carousel-item">
            <div class="hero-slide" style="background: url('{{ asset('images/hero3.jpg') }}') center/cover no-repeat;">
                <div class="overlay"></div>
                <div class="hero-content">
                    <h2 class="fade-up">Best Online Classes</h2>
                    <h1 class="fade-left">FOR KIDS & ADULTS</h1>
                    <h1 class="orange fade-right">ANYTIME</h1>
                    <p class="fade-up">Interactive one-to-one Quran learning</p>
                    <a href="#" class="btn-custom fade-up">➜ Get Started</a>
                </div>
            </div>
        </div>

    </div>

</div>
</section>
<!-- ICON STRIP -->
<section class="icons">
    <div class="icon-strip">
        <div class="container">
            <div class="row text-center align-items-center">

                <!-- CARD 1 -->
                <div class="col-md-4">
                    <div class="icon-box">

                        <div class="popup-wrapper">

                            <!-- Outside Content (desktop only) -->
                            <div class="outside-content">
                                <div class="icon-circle orange">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <small class="popup-text">Learn</small>
                                <h6 class="popup-title">FLEXIBLE TIMINGS</h6>
                            </div>

                            <!-- Popup / Mobile Card -->
                            <div class="popup-card">

                                <div class="popup-top orange"></div>

                                <div class="popup-icon orange">
                                    <i class="bi bi-clock"></i>
                                </div>

                                <div class="popup-bottom">
                                    <p>
                                        Muslims all over the world can select online Quran
                                        class times according to their compatibility and
                                        availability.
                                    </p>

                                    <a href="{{ route('register') }}" class="popup-btn">
                                        REGISTER
                                    </a>

                                    <div class="popup-footer">
                                        <small>Learn</small>
                                        <h6>FLEXIBLE TIMINGS</h6>
                                    </div>
                                </div>

                                <div class="popup-arrow"></div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="col-md-4">
                    <div class="icon-box">

                        <div class="popup-wrapper">

                            <div class="outside-content">
                                <div class="icon-circle blue">
                                    <i class="bi bi-camera-video-fill"></i>
                                </div>
                                <small class="popup-text">Experience</small>
                                <h6 class="popup-title">INTERACTIVE CLASSES</h6>
                            </div>

                            <div class="popup-card">

                                <div class="popup-top video-bg blue"></div>

                                <div class="popup-icon blue">
                                    <i class="bi bi-camera-video-fill"></i>
                                </div>

                                <div class="popup-bottom">
                                    <p>
                                        We use the latest software such as video streaming,
                                        screen sharing and multi-channel audio to make Quran
                                        interactive learning experience.
                                    </p>

                                    <a href="{{ route('register') }}" class="popup-btn">
                                        REGISTER
                                    </a>

                                    <div class="popup-footer">
                                        <small>Experience</small>
                                        <h6>INTERACTIVE CLASSES</h6>
                                    </div>
                                </div>

                                <div class="popup-arrow"></div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="col-md-4">
                    <div class="icon-box">

                        <div class="popup-wrapper">

                            <div class="outside-content">
                                <div class="icon-circle dark">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <small class="popup-text">Learn</small>
                                <h6 class="popup-title">EXPERT QURAN TUTOR</h6>
                            </div>

                            <div class="popup-card">

                                <div class="popup-top tutor-bg dark"></div>

                                <div class="popup-icon dark">
                                    <i class="bi bi-journal-text"></i>
                                </div>

                                <div class="popup-bottom">
                                    <p>
                                        All the online classes of Quran teaching are by Islamic
                                        expert Quran tutors who will teach you the recitation
                                        of Quran as per Arabic phonetics.
                                    </p>

                                    <a href="{{ route('register') }}" class="popup-btn">
                                        REGISTER
                                    </a>

                                    <div class="popup-footer">
                                        <small>Learn</small>
                                        <h6>EXPERT QURAN TUTOR</h6>
                                    </div>
                                </div>

                                <div class="popup-arrow"></div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section><!-- SERVICES -->
<section class="services">
    <div class="container text-center">
        <h5 class="section-title">OUR SERVICES</h5>
        <div class="row mt-5 g-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-box">
                    <div class="service-icon"><i class="bi bi-person-arms-up"></i></div>
                    <h5>QURAN FOR KIDS</h5>
                    <p>
                        Being a Muslims, we are expected to recite the Holy Quran properly and this is the
                        reason why Learning Quran online academy offers various Quranic courses for kids.
                        We offer interactive and one-on-one Quran learning classes to ensure your child
                        can recite the holy Quran without any hesitation and understand the translation as well.
                    </p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-box">
                    <div class="service-icon"><i class="bi bi-person-vcard-fill"></i></div>
                    <h5>LEARN TAJWEED</h5>
                    <p>
                        Beautiful recitation of the Holy Quran is something a lot of us wish to achieve.
                        The starting point to beautify & improve our recitation is to recite the Quran
                        with Tajweed rules. So learn the Quran with Tajweed rules online with qualified
                        and expert tutors.
                    </p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-box">
                    <div class="service-icon"><i class="bi bi-journal-text"></i></div>
                    <h5>LEARN QURAN</h5>
                    <p>
                        Learn Quran with Learning Quran Online academy. Learning Quran is obligatory,
                        so if we do not learn Quran then where will we get guidance. Our only guide line
                        is this Quran. We have now designed a series of Quranic courses for kids and adults
                        such as Quran Memorization and Quran Recitation.
                    </p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="service-box">
                    <div class="service-icon"><i class="bi bi-bookmark-fill"></i></div>
                    <h5>BASIC MASALAH</h5>
                    <p>
                        Muslim children should know good things which are called halal and bad things which
                        are called haram so that they can implement them in their lives for a better life.
                        We have designed Basic Masala courses for kids. This is an important issue which if
                        you do not know how to perform ablution and prayers etc.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section><!-- ABOUT US SECTION -->
<section class="about-us py-5">
    <div class="container">
        <div class="row align-items-center gy-5">

            <!-- LEFT CONTENT (ab hamesha pehle aayega - mobile aur desktop  pe) -->
            <div class="col-lg-6 col-md-12 order-1 order-lg-1">

                <h6 class="about-tag">ABOUT US</h6>

                <h2 class="about-title">
                    Sultana Quran Academy
                </h2>

                <p class="about-text">
                    Sultana Quran Academy is an online Islamic school that has been providing Quran
                    and basic Islamic education since 2021. We offer online Quran classes for
                    children and adults worldwide.
                </p>

                <p class="about-text">
                    We organize one-to-one live interactive Quran classes with qualified teachers
                    who help students learn correct Quran recitation with proper Tajweed.
                </p>

                <a href="{{ route('about') }}" class="about-btn">
                    VIEW DETAIL
                </a>

            </div>

            <!-- RIGHT IMAGES (ab hamesha text ke baad aayega) -->
            <div class="col-lg-6 col-md-12 order-2 order-lg-2">

                <div class="about-images">

                    <!-- Main Image -->
                    <div class="about-img-big">

                        <img src="{{ asset('images/student1.jpg') }}"
                             class="img-fluid rounded"
                             alt="Student">

                        <div class="play-btn">
                            ▶
                        </div>

                    </div>

                    <!-- Small Image -->
                    <div class="about-img-small">

                        <img src="{{ asset('images/student2.jpg') }}"
                             class="img-fluid rounded shadow"
                             alt="Student">

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

{{-- OUR COURSES --}}
<section class="courses py-5">
    <div class="container">

        <h2 class="courses-title">OUR COURSES</h2>

        @php
        $courses = [
            ['slug'=>'tajweed',             'title'=>'Learn Tajweed Online',                 'image'=>'user1.jpg',    'students'=>273],
            ['slug'=>'tarjuma',             'title'=>'Quran Tarjuma Course',                 'image'=>'quran1.jpg',   'students'=>190],
            ['slug'=>'juz30',               'title'=>'Reading the Holy Quran Juz 30',        'image'=>'course3.jpg',  'students'=>320],
            ['slug'=>'basic_islamic',       'title'=>'Basic Islamic Education',              'image'=>'course4.jpg',  'students'=>150],
            ['slug'=>'beginner',            'title'=>'Arabic For Beginners (Noorani Qaida)', 'image'=>'Beginner.jpg', 'students'=>210],
            ['slug'=>'quran-reading-course','title'=>'Reading Quran Course',                 'image'=>'quran.jpg',    'students'=>260],
        ];
        @endphp

        {{-- SWIPER SLIDER ONLY --}}
        <div class="swiper courses-swiper">
            <div class="swiper-wrapper">
                @foreach($courses as $course)
                <div class="swiper-slide">
                    <div class="course-card">
                        <div class="course-image">
                            <img src="{{ asset('images/'.$course['image']) }}" alt="{{ $course['title'] }}">
                            <div class="course-overlay">
                                <a href="{{ route('courses.show', $course['slug']) }}" class="read-btn">READ MORE</a>
                            </div>
                        </div>
                        <div class="course-content">
                            <h5>{{ $course['title'] }}</h5>
                            <div class="course-meta">
                                <span>👤 Ufadmin</span>
                                <span>👥 {{ $course['students'] }}</span>
                            </div>
                            <hr>
                            <div class="course-footer">
                                <div class="stars">★★★★★</div>
                                <span class="free">Free</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ url('/courses') }}" class="view-btn">VIEW ALL COURSES</a>
        </div>

    </div>
</section>


@include('partials.courses-swiper-scripts')
{{-- ==================== PRICING SECTION ==================== --}}
<section class="pricing-section py-5">
    <div class="pricing-overlay py-5">
        <div class="container text-center">

            <h5 class="section-title text-white mb-5">OUR PRICING</h5>

            <div class="row g-4 justify-content-center pricing-row">
                @foreach ($pricings as $plan)
                    <div class="col-12 col-sm-6 col-lg-3 d-flex">
                        <div class="price-card w-100 d-flex flex-column">

                            {{-- Card Header --}}
                            <div class="price-card-header text-center">
                                <h5>{{ strtoupper($plan->plan_name) }}</h5>
                                <span class="divider"></span>
                                <h2>{{ $plan->days_per_week }}</h2>
                                <p>days per week</p>
                            </div>

                            {{-- Card Body --}}
                            <div class="price-card-body d-flex flex-column flex-grow-1">
                                <ul class="flex-grow-1 text-start">
                                    <li><i class="fa fa-check"></i> <strong>{{ $plan->free_trial_days }} Days</strong> Free Trial</li>
                                    <li><i class="fa fa-check"></i> <strong>{{ $plan->minutes_per_day }} Min</strong>/day</li>
                                    <li><i class="fa fa-check"></i> {{ $plan->age_gender }}</li>
                                    <li><i class="fa fa-check"></i> {{ $plan->support }}</li>
                                    <li><i class="fa fa-check"></i> {{ $plan->class_type }}</li>
                                    <li><i class="fa fa-check"></i> <strong>{{ $plan->days_per_week_text }}</strong></li>
                                </ul>

                                <a href="{{ route('register') }}" class="price-btn mt-auto mx-auto">APPLY NOW</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
 <!-- BLOG -->
    <section class="blog-video py-5">
<div class="container">

    <div class="row">

        <!-- BLOG -->
        <div class="col-md-6">
            <h5 class="section-title text-start">FROM BLOG</h5>

            <div class="blog-item d-flex mb-3">
                <img src="/images/blog1.jpg" width="120">
                <div class="ms-3">
                    <h6>Learn Quran Easily</h6>
                    <small>By Admin | Jan 20, 2022</small>
                </div>
            </div>

            <div class="blog-item d-flex mb-3">
                <img src="/images/blog2.jpg" width="120">
                <div class="ms-3">
                    <h6>Islamic Parenting Tips</h6>
                    <small>By Admin | Jan 20, 2022</small>
                </div>
            </div>

            <div class="blog-item d-flex">
                <img src="/images/blog3.jpg" width="120">
                <div class="ms-3">
                    <h6>Teacher Guidance</h6>
                    <small>By Admin | Jan 20, 2022</small>
                </div>
            </div>

            <a href="{{ route('blog.index') }}" class="view-btn mt-3">VIEW ALL</a>
        </div>

        <!-- VIDEOS -->
        <div class="col-md-6">
            <h5 class="section-title text-start">VIDEOS</h5>

            <div class="video-box mb-3">
                <img src="/images/video1.jpg" class="w-100">
                
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="video-box">
                        <img src="/images/video2.jpg" class="w-100">
                        
                    </div>
                </div>

                <div class="col-6">
                    <div class="video-box">
                        <img src="/images/video3.jpg" class="w-100">
                        
                    </div>
                </div>
            </div>

            <a href="{{ url('/') }}" class="view-btn mt-3">VIEW ALL</a>
        </div>

    </div>

</div>
</section>
<!-- TESTIMONIAL CAROUSEL -->
<section class="testimonial-section">
    <div class="container text-center">
        <h3 class="test-title">TESTIMONIAL</h3>
        <p class="test-sub">SULTANA QURAN ACADEMY</p>
        <div class="line"></div>

        <div id="testimonialCarousel" class="carousel slide mt-5"
             data-bs-ride="carousel"
             data-bs-interval="3000">

            <div class="carousel-inner">

                {{-- SLIDE 1 --}}
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="test-card text-center">
                                <img src="/images/user1.jpg" class="test-img mb-3" alt="Saidul Islam">
                                <i class="bi bi-quote quote-icon"></i>
                                <h6 class="quote-title">MashaAllah Best Quran Classes!!</h6>
                                <p>Professional teaching and very comfortable environment.</p>
                                <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                                <h6 class="name">SAIDUL ISLAM</h6>
                                <small>NEW YORK</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SLIDE 2 --}}
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="test-card text-center">
                                <img src="/images/user2.jpg" class="test-img mb-3" alt="MD. Nizam Uddin">
                                <i class="bi bi-quote quote-icon"></i>
                                <h6 class="quote-title">Assalamu Alaikum</h6>
                                <p>My child is improving very fast. Teachers are supportive.</p>
                                <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                                <h6 class="name">MD. NIZAM UDDIN</h6>
                                <small>JAPAN</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SLIDE 3 --}}
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="test-card text-center">
                                <img src="/images/user3.jpg" class="test-img mb-3" alt="Ahmed Khan">
                                <i class="bi bi-quote quote-icon"></i>
                                <h6 class="quote-title">Highly Recommended</h6>
                                <p>Excellent teaching method and friendly teachers.</p>
                                <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                                <h6 class="name">AHMED KHAN</h6>
                                <small>UK</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SLIDE 4 --}}
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="test-card text-center">
                                <img src="/images/user4.jpg" class="test-img mb-3" alt="Fatima Ali">
                                <i class="bi bi-quote quote-icon"></i>
                                <h6 class="quote-title">Great Experience</h6>
                                <p>Very organized classes with flexible timing.</p>
                                <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                                <h6 class="name">FATIMA ALI</h6>
                                <small>CANADA</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- DOTS — ab 4 hain (4 slides) --}}
            <div class="carousel-indicators-custom mt-4">
                <button data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active"></button>
                <button data-bs-target="#testimonialCarousel" data-bs-slide-to="1"></button>
                <button data-bs-target="#testimonialCarousel" data-bs-slide-to="2"></button>
                <button data-bs-target="#testimonialCarousel" data-bs-slide-to="3"></button>
            </div>

        </div>
    </div>
</section>
<section class="our-goal">
    <div class="overlay"></div>
    <div class="container content">
        <h2 class="goal-title">OUR GOAL</h2>
        <p class="goal-text">
            We are trying to reach people through internet to the people who don't have the proper opportunity to learn the holy Quran and its messages. Especially for the Bangladeshi expat.
        </p>
        <a href="{{ route('contact') }}" class="contact-btn">CONTACT US</a>
    </div>
</section>
@include('layouts.footer')