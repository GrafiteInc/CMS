<nav class="navbar navbar-dark bg-dark sticky-top flex-md-nowrap p-0">
    <a class="navbar-brand mr-0 pl-4" href="{{ url('/') }}"><span class="fa fa-cogs"></span> {{ config('cms.backend-title', 'CMS') }}</a>
    <ul class="navbar-nav mr-auto">
        <span class="navbar-text page-title">
            <a class="sidebar-toggle text-light ml-3"><i class="fa fa-bars"></i></a>
            <span class="ml-4">@yield('pageTitle')</span>
        </span>
    </ul>
    <ul class="navbar-nav ml-auto px-3">
        <li class="nav-item">
            @if (Auth::user())
                <a class="nav-link" href="{{ url('/logout') }}">Sign out</a>
            @endif
        </li>
    </ul>
</nav>
