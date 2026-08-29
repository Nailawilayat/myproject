@include('layouts.header')
@include('layouts.hero')

<!-- ================= ABOUT ================= -->

<section class="py-5">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h2 class="fw-bold mb-3">
                    ABOUT US
                </h2>

                <div class="heading-line mb-4"></div>

                <p class="about-text">

    Sultana Quran Academy is an online Islamic school that has been providing
    Quran and basic level Islamic teaching services globally since 2001.

    We are providing online Quran teaching services to kids and adults,
    male and female, across the globe. We organize one-to-one live
    interactive Quran classes, and all our teachers are experts in
    proper Quran pronunciation.

    Our Quran learning courses are specially designed for you and your
    children. Under the guidance of qualified Quran tutors, we provide
    step-by-step Quran learning with the rules of Tajweed and essential
    Islamic knowledge.

    If you are looking for an online Quran tutor for yourself or your
    children, join Sultana Quran Academy and learn the Holy Quran through
    one-to-one live online classes from the comfort of your home.

</p>

            </div>

            <div class="col-lg-6 text-center">

                <img src="{{ asset('images/about.jpg') }}"
                     class="img-fluid rounded shadow-lg"
                     alt="About">

            </div>

        </div>

    </div>
</section>

<!-- ================= WHO WE ARE ================= -->

<section class="py-5 bg-light">

    <div class="container">

        <h2 class="text-center fw-bold">
            WHO WE ARE
        </h2>

        <div class="heading-line mx-auto mb-5"></div>

        <div class="row">

            <div class="col-lg-12">

                <p class="about-text">

    We are a team of Muslims who are eager to spread the message of
    the Holy Quran and Sunnah through the easiest and most effective
    online learning methods.

    At Sultana Quran Academy, our mission is not only teaching but also
    helping Muslims stay connected with Islam wherever they live.

    We offer online Quran courses that help children and adults learn
    Quran in a simple, engaging, and practical way.

    If you are interested in joining our academy, simply complete the
    registration form and we will contact you as soon as possible.

    For any questions or further discussion, you may also call our support team.

</p>

<ul class="about-list">

    <li>
        If the participants are kids, don't worry. Our experienced tutors
        teach children using simple, enjoyable and effective methods.
    </li>

    <li>
        All classes are conducted online through reliable platforms such as
        Skype and modern communication tools.
    </li>

    <li>
        Practical assignments are given after every session.
    </li>

    <li>
        Practical training is included to improve learning.
    </li>

</ul>

                <ul class="about-list">

                    <li>Expert Male & Female Quran Tutors</li>

                    <li>One-to-One Live Quran Classes</li>

                    <li>Classes for Kids & Adults</li>

                    <li>Flexible Timings Worldwide</li>

                    <li>Practical Assignments after Every Session</li>

                </ul>

            </div>

        </div>

    </div>

</section>

<!-- ================= CERTIFICATES ================= -->

<section class="py-5">
    <div class="container">

        <h2 class="text-center fw-bold">CERTIFICATES</h2>
        <p class="text-center mb-5">Take a look at our certificates</p>

        <div class="cert-slider-outer overflow-hidden">
            <div class="cert-track">

                @foreach($certificates as $certificate)
                    <div class="cert-item">
                        <img src="{{ asset($certificate->image) }}"
                             class="img-fluid w-100"
                             alt="{{ $certificate->title }}">
                    </div>
                @endforeach

                {{-- Duplicate for infinite loop --}}
                @foreach($certificates as $certificate)
                    <div class="cert-item">
                        <img src="{{ asset($certificate->image) }}"
                             class="img-fluid w-100"
                             alt="{{ $certificate->title }}">
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</section>


</style>
</div>

</div>

</div>

</section>

</section>

<!-- ================= BROWSE ================= -->

<section class="browse-section">

<div class="container-fluid">

<div class="row g-0">

<div class="col-lg-4">

<div class="browse-box">

<img src="{{ asset('images/course.jpg') }}">

<div class="overlay">

<h4>Browse</h4>

<h2>COURSES</h2>

<a href="{{ url('/courses') }}" class="btn btn-light">

View Courses

</a>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="browse-box">

<img src="{{ asset('images/books.jpg') }}">

<div class="overlay">

<h4>View Islamic</h4>

<h2>BOOKS</h2>

<a href="{{ url('/books') }}" class="btn btn-light">

View Books

</a>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="browse-box">

<img src="{{ asset('images/contact.jpg') }}">

<div class="overlay">

<h4>Make a</h4>

<h2>CONTACT</h2>

<a href="{{ url('/contact') }}" class="btn btn-light">

Contact Us

</a>

</div>

</div>

</div>

</div>

</div>

</section>

@include('layouts.footer')