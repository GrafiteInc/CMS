<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
            @menu('main', 'cms-frontend::partials.main-menu')
            <li class="nav-item"><a class="nav-link" href="{{ url('blog') }}">Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('events') }}">Events</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('faqs') }}">FAQs</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('gallery') }}">Gallery</a></li>
            @modules()
            @languages()
        </ul>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                @if (auth()->user())
                    <a class="nav-link" href="{!! url('user/settings') !!}"><span class="fa fa-fw fa-user"></span> Settings</a>
                @else
                    <a class="nav-link" href="{!! url('login') !!}"><span class="fa fa-fw fa-sign-in"></span> Login</a>
                @endif
            </li>
        </ul>
    </div>
</nav>

