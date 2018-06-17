<script>
    @if (Session::has("notification"))
        cmsNotify("{{ Session::get("notification") }}", "{{ Session::get("notificationType") }}");
    @endif

    @if (Session::has("message"))
        cmsNotify("{{ Session::get("message") }}", "alert-info");
    @endif

    @if (Session::has("success"))
        cmsNotify("{{ Session::get("success") }}", "alert-success");
    @endif

    @if (Session::has("errors") && count(Session::get("errors")) >= 1)
        cmsNotify("{!! collect($errors->all())->implode('<br>') !!}", "alert-danger");
    @endif
</script>
