<ul class="nav nav-sidebar">
    <li class="@if (Request::is('quarx/dashboard')) active @endif">
        <a href="{!! url('quarx/dashboard') !!}"><span class="fa fa-dashboard"></span> Dashboard</a>
    </li>

    @if (in_array('images', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is('quarx/images') || Request::is('quarx/images/*')) active @endif">
            <a href="{!! url('quarx/images') !!}"><span class="fa fa-image"></span> Images</a>
        </li>
    @endif

    @if (in_array('files', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is('quarx/files') || Request::is('quarx/files/*')) active @endif">
            <a href="{!! url('quarx/files') !!}"><span class="fa fa-file"></span> Files</a>
        </li>
    @endif

    @if (in_array('blog', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is('quarx/blog') || Request::is('quarx/blog/*')) active @endif">
            <a href="{!! url('quarx/blog') !!}"><span class="fa fa-pencil"></span> Blog</a>
        </li>
    @endif

    @if (in_array('menus', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is('quarx/menus') || Request::is('quarx/menus/*') || Request::is('quarx/links') || Request::is('quarx/links/*')) active @endif">
            <a href="{!! url('quarx/menus') !!}"><span class="fa fa-link"></span> Menus</a>
        </li>
    @endif

    @if (in_array('pages', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is('quarx/pages') || Request::is('quarx/pages/*')) active @endif">
            <a href="{!! url('quarx/pages') !!}"><span class="fa fa-file-text-o"></span> Pages</a>
        </li>
    @endif

    @if (in_array('widgets', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is('quarx/widgets') || Request::is('quarx/widgets/*')) active @endif">
            <a href="{!! url('quarx/widgets') !!}"><span class="fa fa-gear"></span> Widgets</a>
        </li>
    @endif

    @if (in_array('faqs', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is('quarx/faqs') || Request::is('quarx/faqs/*')) active @endif">
            <a href="{!! url('quarx/faqs') !!}"><span class="fa fa-question"></span> FAQs</a>
        </li>
    @endif

    @if (in_array('events', Config::get('quarx.active-core-modules', Quarx::defaultModules())))
        <li class="@if (Request::is('quarx/events') || Request::is('quarx/events/*')) active @endif">
            <a href="{!! url('quarx/events') !!}"><span class="fa fa-calendar"></span> Events</a>
        </li>
    @endif

    {!! ModuleService::menus() !!}
    {!! Quarx::packageMenus() !!}

    @if (Route::get('user/settings'))
        <li class="@if (Request::is('user/settings') || Request::is('user/password')) active @endif">
            <a href="{!! url('user/settings') !!}"><span class="fa fa-gear"></span> Settings</a>
        </li>
    @endif

    <li class="@if (Request::is('quarx/help')) active @endif">
        <a href="{!! url('quarx/help') !!}"><span class="fa fa-info-circle"></span> Help</a>
    </li>

    @if (Route::get('admin/users')) <li class="sidebar-header"><span>Admin</span></li> @endif

    @if (Route::get('admin/users'))
        <li class="@if (Request::is('admin/users') || Request::is('admin/users/*')) active @endif">
            <a href="{!! url('admin/users') !!}"><span class="fa fa-users"></span> Users</a>
        </li>
    @endif
    @if (Route::get('admin/roles'))
        <li class="@if (Request::is('admin/roles') || Request::is('admin/roles/*')) active @endif">
            <a href="{!! url('admin/roles') !!}"><span class="fa fa-lock"></span> Roles</a>
        </li>
    @endif
</ul>