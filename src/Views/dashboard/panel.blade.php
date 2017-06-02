<ul class="nav nav-sidebar">
    <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/dashboard')) active @endif">
        <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/dashboard') !!}"><span class="fa fa-fw fa-dashboard"></span> Dashboard</a>
    </li>

    <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/help')) active @endif">
        <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/help') !!}"><span class="fa fa-fw fa-info-circle"></span> Help</a>
    </li>

    @if (Route::get('user/settings'))
        <li class="@if (Request::is('user/settings') || Request::is('user/password')) active @endif">
            <a href="{!! url('user/settings') !!}"><span class="fa fa-fw fa-gear"></span> Settings</a>
        </li>
    @endif

    @if (in_array('images', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/images') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/images/*')) active @endif">
            <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/images') !!}"><span class="fa fa-fw fa-image"></span> Images</a>
        </li>
    @endif

    @if (in_array('files', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/files') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/files/*')) active @endif">
            <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/files') !!}"><span class="fa fa-fw fa-file"></span> Files</a>
        </li>
    @endif

    @if (in_array('menus', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/menus') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/menus/*') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/links') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/links/*')) active @endif">
            <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/menus') !!}"><span class="fa fa-fw fa-link"></span> Menus</a>
        </li>
    @endif

    @if (in_array('widgets', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/widgets') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/widgets/*')) active @endif">
            <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/widgets') !!}"><span class="fa fa-fw fa-gear"></span> Widgets</a>
        </li>
    @endif

    @if (in_array('blog', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/blog') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/blog/*')) active @endif">
            <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/blog') !!}"><span class="fa fa-fw fa-pencil"></span> Blog</a>
        </li>
    @endif

    @if (in_array('pages', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/pages') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/pages/*')) active @endif">
            <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/pages') !!}"><span class="fa fa-fw fa-file-text-o"></span> Pages</a>
        </li>
    @endif

    @if (in_array('faqs', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/faqs') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/faqs/*')) active @endif">
            <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/faqs') !!}"><span class="fa fa-fw fa-question"></span> FAQs</a>
        </li>
    @endif

    @if (in_array('events', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is(config('quarx.backend-route-prefix', 'quarx').'/events') || Request::is(config('quarx.backend-route-prefix', 'quarx').'/events/*')) active @endif">
            <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/events') !!}"><span class="fa fa-fw fa-calendar"></span> Events</a>
        </li>
    @endif

    {!! ModuleService::menus() !!}

    {!! Quarx::packageMenus() !!}

    @if (Route::get('admin/users')) <li class="sidebar-header"><span>Admin</span></li> @endif

    @if (Route::get('admin/dashboard'))
        <li class="@if (Request::is('admin/dashboard') || Request::is('admin/dashboard/*')) active @endif">
            <a href="{!! url('admin/dashboard') !!}"><span class="fa fa-fw fa-dashboard"></span> Dashboard</a>
        </li>
    @endif
    @if (Route::get('admin/users'))
        <li class="@if (Request::is('admin/users') || Request::is('admin/users/*')) active @endif">
            <a href="{!! url('admin/users') !!}"><span class="fa fa-fw fa-users"></span> Users</a>
        </li>
    @endif
    @if (Route::get('admin/roles'))
        <li class="@if (Request::is('admin/roles') || Request::is('admin/roles/*')) active @endif">
            <a href="{!! url('admin/roles') !!}"><span class="fa fa-fw fa-lock"></span> Roles</a>
        </li>
    @endif
</ul>
