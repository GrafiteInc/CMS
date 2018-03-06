<ul class="nav nav-sidebar">
    <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/dashboard')) active @endif">
        <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/dashboard') !!}"><span class="fa fa-fw fa-dashboard"></span> Dashboard</a>
    </li>

    <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/help')) active @endif">
        <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/help') !!}"><span class="fa fa-fw fa-info-circle"></span> Help</a>
    </li>

    @if (Route::get('user/settings'))
        <li class="@if (Request::is('user/settings') || Request::is('user/password')) active @endif">
            <a href="{!! url('user/settings') !!}"><span class="fa fa-fw fa-gear"></span> Settings</a>
        </li>
    @endif

    @if (in_array('images', Config::get('cabin.active-core-modules', Cabin::defaultModules())))
        <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/images') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/images/*')) active @endif">
            <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/images') !!}"><span class="fa fa-fw fa-image"></span> Images</a>
        </li>
    @endif

    @if (in_array('files', Config::get('cabin.active-core-modules', Cabin::defaultModules())))
        <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/files') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/files/*')) active @endif">
            <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/files') !!}"><span class="fa fa-fw fa-file"></span> Files</a>
        </li>
    @endif

    @if (in_array('menus', Config::get('cabin.active-core-modules', Cabin::defaultModules())))
        <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/menus') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/menus/*') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/links') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/links/*')) active @endif">
            <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/menus') !!}"><span class="fa fa-fw fa-link"></span> Menus</a>
        </li>
    @endif

    @if (in_array('widgets', Config::get('cabin.active-core-modules', Cabin::defaultModules())))
        <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/widgets') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/widgets/*')) active @endif">
            <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/widgets') !!}"><span class="fa fa-fw fa-gear"></span> Widgets</a>
        </li>
    @endif

    @if (in_array('blog', Config::get('cabin.active-core-modules', Cabin::defaultModules())))
        <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/blog') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/blog/*')) active @endif">
            <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/blog') !!}"><span class="fa fa-fw fa-pencil"></span> Blog</a>
        </li>
    @endif

    @if (in_array('pages', Config::get('cabin.active-core-modules', Cabin::defaultModules())))
        <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/pages') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/pages/*')) active @endif">
            <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/pages') !!}"><span class="fa fa-fw fa-file-text-o"></span> Pages</a>
        </li>
    @endif

    @if (in_array('faqs', Config::get('cabin.active-core-modules', Cabin::defaultModules())))
        <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/faqs') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/faqs/*')) active @endif">
            <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/faqs') !!}"><span class="fa fa-fw fa-question"></span> FAQs</a>
        </li>
    @endif

    @if (in_array('events', Config::get('cabin.active-core-modules', Cabin::defaultModules())))
        <li class="@if (Request::is(config('cabin.backend-route-prefix', 'cabin').'/events') || Request::is(config('cabin.backend-route-prefix', 'cabin').'/events/*')) active @endif">
            <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/events') !!}"><span class="fa fa-fw fa-calendar"></span> Events</a>
        </li>
    @endif

    {!! ModuleService::menus() !!}

    {!! Cabin::packageMenus() !!}

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
