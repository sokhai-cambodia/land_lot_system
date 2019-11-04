
<script>
@if(Session::has('delete-message'))
    var message = '{{ Session::get("delete-message") }}';

    Swal.fire(
        'Deleted!',
        message,
        'success'
    )
   
@endif
</script>