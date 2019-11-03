<script>
@if(Session::has('delete-message'))
    var message = '{{ Session::get("delete-message") }}';

    swal(
        'Deleted!',
        message,
        'success'
    )
   
@endif
</script>