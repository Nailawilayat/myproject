<script>
function showLoginAlert(e) {
    e.preventDefault();

    Swal.fire({
        icon: 'warning',
        title: 'Login Required',
        text: 'Please login first to view books.',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = "{{ route('login.redirect', ['url' => url('/books')]) }}";
    });
}
</script>