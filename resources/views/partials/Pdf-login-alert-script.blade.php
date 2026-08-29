
<script>
function showPdfLoginAlert(e, pdfUrl)
{
    e.preventDefault();

    Swal.fire({
        icon: 'warning',
        title: 'Login Required',
        text: 'Please login first to view the curriculum PDF.',
        confirmButtonText: 'Login',
        confirmButtonColor: '#f39c12'
    }).then((result) => {

        if (result.isConfirmed) {

            // PDF URL save karke login page par bhejna
            const loginUrl =
                "{{ route('login.redirect') }}" +
                "?url=" +
                encodeURIComponent(pdfUrl);

            window.location.href = loginUrl;
        }
    });
}
</script>

