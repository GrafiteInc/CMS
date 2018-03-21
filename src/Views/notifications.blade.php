<script>
    @if (Session::has("notification"))
        cmsNotify("{{ Session::get("notification") }}", "{{ Session::get("notificationType") }}");
    @endif

    @if (Session::has("message"))
        cmsNotify("{{ Session::get("message") }}", "alert-info");
    @endif

    @if (Session::has("errors"))
        @foreach ($errors->all() as $error)
            cmsNotify("{{ $error }}", "alert-danger");
        @endforeach
    @endif
</script>
