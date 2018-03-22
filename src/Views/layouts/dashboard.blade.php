@extends('cms::layouts.master')

@section('app-content')

    @include('cms::layouts.notifications')

    <nav id="sidebar" class="sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                @include('cms::dashboard.panel')
            </ul>
        </div>
    </nav>

    <main class="ml-sm-auto pt-2 px-2 main">
        @yield('content')
    </main>

    <footer class="footer bg-light">
        <div class="container-fluid">
            <span class="text-muted">Brought to you by <a href="https://grafite.ca">Grafite Inc</a>.</span>
        </div>
    </footer>
@stop

@section('javascript')
    {!! Minify::javascript(Cms::asset('js/dashboard.js', 'application/javascript')) !!}
    {!! Minify::javascript(Cms::asset('js/chart.min.js', 'application/javascript')) !!}
@stop
