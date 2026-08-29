<script>
document.addEventListener("DOMContentLoaded", function () {

    const clock = document.getElementById("clockIcon");
    const modal = document.getElementById("timingModal");

    const bsModal = new bootstrap.Modal(modal);

    clock.addEventListener("mouseenter", function () {
        bsModal.show();
    });

    modal.addEventListener("mouseleave", function () {
        bsModal.hide();
    });

});
</script>