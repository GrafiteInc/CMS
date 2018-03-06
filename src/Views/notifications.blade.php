
@if (Session::has("notification"))
    cabinNotify("{{ Session::get("notification") }}", "{{ Session::get("notificationType") }}");
@endif

@if (Session::has("message"))
    cabinNotify("{{ Session::get("message") }}", "alert-info");
@endif

@if (Session::has("errors"))
    @foreach ($errors->all() as $error)
        cabinNotify("{{ $error }}", "alert-danger");
    @endforeach
@endif