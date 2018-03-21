<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('/') }}"><span class="fa fa-arrow-left"></span> Back To Site </a>
</li>

<li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/dashboard')) active @endif">
    <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/dashboard') !!}"><span class="fa fa-fw fa-chart-line"></span> Dashboard</a>
</li>

<li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/help')) active @endif">
    <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/help') !!}"><span class="fa fa-fw fa-info-circle"></span> Help</a>
</li>

@if (Route::get('user/settings'))
    <li class="nav-item @if (Request::is('user/settings') || Request::is('user/password')) active @endif">
        <a class="nav-link" href="{!! url('user/settings') !!}"><span class="fa fa-fw fa-wrench"></span> Settings</a>
    </li>
@endif

@if (in_array('images', Config::get('cms.active-core-modules', Cms::defaultModules())))
    <li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/images') || Request::is(config('cms.backend-route-prefix', 'cms').'/images/*')) active @endif">
        <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/images') !!}"><span class="fa fa-fw fa-image"></span> Images</a>
    </li>
@endif

@if (in_array('files', Config::get('cms.active-core-modules', Cms::defaultModules())))
    <li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/files') || Request::is(config('cms.backend-route-prefix', 'cms').'/files/*')) active @endif">
        <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/files') !!}"><span class="fa fa-fw fa-file"></span> Files</a>
    </li>
@endif

@if (in_array('menus', Config::get('cms.active-core-modules', Cms::defaultModules())))
    <li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/menus') || Request::is(config('cms.backend-route-prefix', 'cms').'/menus/*') || Request::is(config('cms.backend-route-prefix', 'cms').'/links') || Request::is(config('cms.backend-route-prefix', 'cms').'/links/*')) active @endif">
        <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/menus') !!}"><span class="fa fa-fw fa-link"></span> Menus</a>
    </li>
@endif

@if (in_array('widgets', Config::get('cms.active-core-modules', Cms::defaultModules())))
    <li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/widgets') || Request::is(config('cms.backend-route-prefix', 'cms').'/widgets/*')) active @endif">
        <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/widgets') !!}"><span class="fa fa-fw fa-cogs"></span> Widgets</a>
    </li>
@endif

@if (in_array('blog', Config::get('cms.active-core-modules', Cms::defaultModules())))
    <li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/blog') || Request::is(config('cms.backend-route-prefix', 'cms').'/blog/*')) active @endif">
        <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/blog') !!}"><span class="fa fa-fw fa-pencil-alt"></span> Blog</a>
    </li>
@endif

@if (in_array('pages', Config::get('cms.active-core-modules', Cms::defaultModules())))
    <li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/pages') || Request::is(config('cms.backend-route-prefix', 'cms').'/pages/*')) active @endif">
        <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/pages') !!}"><span class="fa fa-fw fa-file-alt"></span> Pages</a>
    </li>
@endif

@if (in_array('faqs', Config::get('cms.active-core-modules', Cms::defaultModules())))
    <li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/faqs') || Request::is(config('cms.backend-route-prefix', 'cms').'/faqs/*')) active @endif">
        <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/faqs') !!}"><span class="fa fa-fw fa-question"></span> FAQs</a>
    </li>
@endif

@if (in_array('events', Config::get('cms.active-core-modules', Cms::defaultModules())))
    <li class="nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/events') || Request::is(config('cms.backend-route-prefix', 'cms').'/events/*')) active @endif">
        <a class="nav-link" href="{!! url(config('cms.backend-route-prefix', 'cms').'/events') !!}"><span class="fa fa-fw fa-calendar"></span> Events</a>
    </li>
@endif

{!! ModuleService::menus() !!}

{!! Cms::packageMenus() !!}

@if (Route::get('admin/users'))
    <li class="sidebar-header"><span>Admin</span></li>
@endif

@if (Route::get('admin/dashboard'))
    <li class="nav-item @if (Request::is('admin/dashboard') || Request::is('admin/dashboard/*')) active @endif">
        <a class="nav-link" href="{!! url('admin/dashboard') !!}"><span class="fa fa-fw fa-tachometer-alt"></span> Dashboard</a>
    </li>
@endif
@if (Route::get('admin/users'))
    <li class="nav-item @if (Request::is('admin/users') || Request::is('admin/users/*')) active @endif">
        <a class="nav-link" href="{!! url('admin/users') !!}"><span class="fa fa-fw fa-users"></span> Users</a>
    </li>
@endif
@if (Route::get('admin/roles'))
    <li class="nav-item @if (Request::is('admin/roles') || Request::is('admin/roles/*')) active @endif">
        <a class="nav-link" href="{!! url('admin/roles') !!}"><span class="fa fa-fw fa-lock"></span> Roles</a>
    </li>
@endif
