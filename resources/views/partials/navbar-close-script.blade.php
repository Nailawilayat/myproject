<script>
document.addEventListener('DOMContentLoaded', function () {
    const menu = document.getElementById('menu');
    if (!menu) return;

    const bsCollapse = new bootstrap.Collapse(menu, { toggle: false });

    // Har normal nav-link pe click hone se menu close ho jaye
    menu.querySelectorAll('.nav-link:not(.dropdown-toggle)').forEach(function (link) {
        link.addEventListener('click', function () {
            bsCollapse.hide();
        });
    });

    // Dropdown item click pe bhi close ho jaye
    menu.querySelectorAll('.dropdown-item').forEach(function (item) {
        item.addEventListener('click', function () {
            bsCollapse.hide();
        });
    });

    // Menu ke bahar click karne se bhi close ho jaye
    document.addEventListener('click', function (event) {
        const isClickInsideMenu = menu.contains(event.target);
        const isToggler = event.target.closest('.navbar-toggler');
        if (!isClickInsideMenu && !isToggler && menu.classList.contains('show')) {
            bsCollapse.hide();
        }
    });
});
</script>