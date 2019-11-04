<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
<!-- Toastr -->
<script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>

<script>
@if(Session::has('message'))
    var type = "{{ Session::get('type', 'info') }}";
    var message = '{{ Session::get("message") }}';
    var info = '{{ NotificationHelper::NOTIFICATION_INFO }}';
    var warning = '{{ NotificationHelper::NOTIFICATION_WARNING }}';
    var success = '{{ NotificationHelper::NOTIFICATION_SUCCESS }}';
    var error = '{{ NotificationHelper::NOTIFICATION_ERROR }}';
    switch(type) {
        case info:
            toastr.info(message, info);
            break;

        case warning:
            toastr.warning(message, warning);
            break;

        case success:
            toastr.success(message, success);
            break;

        case error:
            toastr.error(message, error);
            break;
    }
@endif

</script>
