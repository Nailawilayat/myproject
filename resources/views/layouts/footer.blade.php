<footer class="footer-section pt-5 pb-3">

    <div class="container">

        <!-- LOGO -->
        <div class="footer-logo text-center mb-4">

            <img src="{{ !empty($siteSettings['site_logo']) ? asset($siteSettings['site_logo']) : asset('images/logo.png') }}"
                 alt="{{ $siteSettings['site_name'] ?? 'Sultana Quran Academy' }}"
                 style="width:180px;height:180px;border-radius:50%;object-fit:cover;">

            <h3 class="text-white mt-3 fw-bold">
                {{ $siteSettings['site_name'] ?? 'Sultana Quran Academy' }}
            </h3>

            <p class="text-light">
                Learn Quran Online With Expert Male & Female Tutors
            </p>

        </div>

        <div class="row">

            <!-- QUICK CONTACT -->
            <div class="col-md-3 mb-4">

                <h5 class="footer-heading">
                    QUICK CONTACT
                </h5>

                <ul class="footer-links list-unstyled">

                    <li>
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ $siteSettings['contact_phone'] ?? '+923433367079' }}">
                            {{ $siteSettings['contact_phone'] ?? '+92 343 3367079' }}
                        </a>
                    </li>

                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@sultanaquranacademy.com' }}">
                            {{ $siteSettings['contact_email'] ?? 'info@sultanaquranacademy.com' }}
                        </a>
                    </li>

                    <li>
                        <i class="fas fa-globe"></i>
                        <a href="https://www.sultanaquranacademy.com" target="_blank">
                            www.sultanaquranacademy.com
                        </a>
                    </li>

                    <li>
                        <i class="fas fa-location-dot"></i>
                        {{ $siteSettings['address'] ?? 'Online Quran Classes Worldwide' }}
                    </li>

                </ul>

            </div>

            <!-- USEFUL LINKS -->
            <div class="col-md-3 mb-4">

                <h5 class="footer-heading">
                    USEFUL LINKS
                </h5>

                <ul class="footer-links list-unstyled">

                    <li>
                        <a href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/about') }}">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/courses') }}">
                            Courses
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/pricing') }}">
                            Pricing
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/books') }}">
                            Books
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/contact') }}">
                            Contact Us
                        </a>
                    </li>

                </ul>

            </div>

            <!-- OUR COURSES -->
            <div class="col-md-3 mb-4">

                <h5 class="footer-heading">
                    OUR COURSES
                </h5>

                <ul class="footer-links list-unstyled">

                    <li>
                        <a href="{{ url('/courses/beginner') }}">
                            Beginner Quran Course
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/courses/quran-reading-course') }}">
                            Quran Reading Course
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/courses/tajweed') }}">
                            Learn Tajweed Online
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/courses/tarjuma') }}">
                            Tarjuma-tul-Quran
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/courses/juz30') }}">
                            Reading Holy Quran-Juz 30
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/courses/basic_islamic') }}">
                            Basic Islamic Education
                        </a>
                    </li>

                </ul>

            </div>

            <!-- SOCIAL LINKS -->
            <div class="col-md-3 mb-4">

                <h5 class="footer-heading">
                    FOLLOW US
                </h5>

                <ul class="footer-links list-unstyled">

                    <li>
                        <a href="https://facebook.com/Sultana Quran Academy" target="_blank">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                    </li>

                    <li>
                        <a href="https://instagram.com/" target="_blank">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                    </li>

                   <li>
    <a href="mailto:sultanaislamicacademy@gmail.com" target="_blank">
        <i class="fas fa-envelope"></i> Gmail
    </a>
</li>

                    <li>
                        <a href="https://wa.me/923433367079" target="_blank">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </li>

                </ul>

            </div>

        </div>

        <!-- FOOTER BOTTOM -->
        <div class="footer-bottom text-center pt-3 border-top">

            <p class="mb-0 text-light">
                © {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'Sultana Quran Academy' }}.
                All Rights Reserved.
            </p>

        </div>

    </div>

</footer>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const pdfId = urlParams.get('open_pdf');

    if (pdfId) {
        const modalEl = document.getElementById('pdfModal' + pdfId);

        if (modalEl) {
            const curriculumTabTrigger = document.querySelector('a[href="#curriculum"], button[data-bs-target="#curriculum"]');
            if (curriculumTabTrigger) {
                const tab = new bootstrap.Tab(curriculumTabTrigger);
                tab.show();
            }

            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }

        const cleanUrl = window.location.pathname;
        window.history.replaceState({}, document.title, cleanUrl);
    }
});
</script>
@endpush
</body>
</html>