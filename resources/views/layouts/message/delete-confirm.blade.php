<script>
    $(document).ready(function() {
        // delete popup
        $('body').on('click', '.btn-delete', function() {
            var url = $(this).attr('data-url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3f51b5',
                cancelButtonColor: '#ff4081',
                confirmButtonText: 'Confirm ',
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                } 
            })
        });

        
    });
</script>