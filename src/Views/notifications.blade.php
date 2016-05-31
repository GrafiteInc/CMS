
@if (Session::has("notification"))
    quarxNotify("{{ Session::get("notification") }}", "{{ Session::get("notificationType") }}");
@endif

@if (Session::has("message"))
    quarxNotify("{{ Session::get("message") }}", "alert-info");
@endif

@if (Session::has("errors"))
    @foreach ($errors->all() as $error)
        quarxNotify("{{ $error }}", "alert-danger");
    @endforeach
@endif