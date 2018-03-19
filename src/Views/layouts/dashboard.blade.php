@extends('cms::layouts.navigation')

@section('page-content')

    <div class="overlay"></div>

    <div class="raw100 raw-left raw-margin-top-50">
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="raw100 raw-left raw-margin-bottom-90">
                @include('cms::dashboard.panel')
            </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="raw100 raw-left navbar navbar-fixed-bottom">
        <div class="raw100 raw-left cms-footer">
            <p class="raw-margin-left-20 pull-left">Brought to you by: <a href="https://grafite.ca">Grafite Inc.</a></p>
            <p class="raw-margin-right-20 pull-right">v. {{ Cms::version() }}</p>
        </div>
    </div>
@stop

@section('javascript')
    {!! Minify::javascript(Cms::asset('js/dashboard.js', 'application/javascript')) !!}
    {!! Minify::javascript(Cms::asset('js/chart.min.js', 'application/javascript')) !!}
@stop
