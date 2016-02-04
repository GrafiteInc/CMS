
<div class="raw-margin-top-16 raw-margin-bottom-24">
    <div class="btn-group" role="group" aria-label="...">
        <a class="btn btn-default" href="/dashboard">Site Dashboard</a>
        <a class="btn btn-default" href="/quarx/dashboard">Quarx CMS</a>
        <a class="btn btn-default" href="/account/settings">Account Settings</a>
        @if (Auth::user()->can('admin'))
        <a class="btn btn-default" href="/admin/accounts">Account Admin</a>
        <a class="btn btn-default" href="/teams">Team Manager</a>
        @endif
    </div>
</div>

