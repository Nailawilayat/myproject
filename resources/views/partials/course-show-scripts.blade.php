{{-- Auto-sliding "YOU MAY LIKE" related-courses slider script. --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('youMayLikeSlider');
        if (!slider) return;

        const intervalTime = 3000; // time between auto slides (ms)
        let autoSlideTimer = null;

        function stepSlide() {
            const card = slider.querySelector('.slider-card');
            if (!card) return;

            const gap = parseInt(getComputedStyle(slider).columnGap || getComputedStyle(slider).gap || 16);
            const step = card.offsetWidth + gap;

            const atEnd = slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 5;

            if (atEnd) {
                slider.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                slider.scrollBy({ left: step, behavior: 'smooth' });
            }
        }

        function startAutoSlide() {
            stopAutoSlide();
            autoSlideTimer = setInterval(stepSlide, intervalTime);
        }

        function stopAutoSlide() {
            if (autoSlideTimer) clearInterval(autoSlideTimer);
        }

        // pause on hover/touch so users can browse manually, resume after they leave
        slider.addEventListener('mouseenter', stopAutoSlide);
        slider.addEventListener('mouseleave', startAutoSlide);
        slider.addEventListener('touchstart', stopAutoSlide, { passive: true });
        slider.addEventListener('touchend', startAutoSlide, { passive: true });

        startAutoSlide();
    });

    // If we arrived here via #curriculum (e.g. redirected back after login),
    // open the Curriculum tab automatically instead of leaving Overview active.
    document.addEventListener('DOMContentLoaded', function () {
        if (window.location.hash === '#curriculum') {
            const curriculumTabBtn = document.querySelector('a[data-bs-toggle="tab"][href="#curriculum"]');
            if (curriculumTabBtn && window.bootstrap) {
                new bootstrap.Tab(curriculumTabBtn).show();
            } else if (curriculumTabBtn) {
                curriculumTabBtn.click();
            }
        }
    });
</script>