<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.popup-wrapper').forEach(function (wrapper) {
        wrapper.addEventListener('click', function (e) {
            // Agar already koi aur popup open hai to close kar dein
            document.querySelectorAll('.popup-wrapper.active').forEach(function (w) {
                if (w !== wrapper) w.classList.remove('active');
            });

            wrapper.classList.toggle('active');
        });
    });

    // Bahar tap karne par band ho jaye
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.popup-wrapper')) {
            document.querySelectorAll('.popup-wrapper.active').forEach(function (w) {
                w.classList.remove('active');
            });
        }
    });

});
</script>