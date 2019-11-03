<!-- Toast.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('plugin/cms/assets/css/jquery.toast.css') }}">
<!-- toast js -->
<script src="{{ asset('plugin/cms/assets/js/jquery.toast.js') }}"></script>

<script>
@if(Session::has('message'))
    var type = "{{ Session::get('type', 'info') }}";
    var message = '{{ Session::get("message") }}';
    var info = '{{ NotificationHelper::NOTIFICATION_INFO }}';
    var warning = '{{ NotificationHelper::NOTIFICATION_WARNING }}';
    var success = '{{ NotificationHelper::NOTIFICATION_SUCCESS }}';
    var error = '{{ NotificationHelper::NOTIFICATION_ERROR }}';
    switch(type){
        case info:
            showToast(
                info,
                message,
                info
            );
            break;

        case warning:
            showToast(
                warning,
                message,
                warning
            );
            break;

        case success:
            showToast(
                success,
                message,
                success
            );
            break;

        case error:
            showToast(
                error,
                message,
                error
            );
            break;
    }
@endif

function showToast(heading, text, icon, position='top-right', loader=true) {
    $.toast({
        position: 'top-right',
        heading: heading.toUpperCase(),
        text: text,
        icon: icon,
        loader: loader,
    })
}
</script>
