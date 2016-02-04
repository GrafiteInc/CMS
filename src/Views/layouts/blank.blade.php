@extends('quarx::layouts.navigation')

@section('page-content')

    <div class="overlay"></div>

    {!! Minify::stylesheet(Quarx::asset('css/dashboard.css', 'text/css')) !!}

    <div class="row raw-margin-top-50">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>

    <div class="raw100 raw-left navbar navbar-fixed-bottom">
        <div class="raw100 raw-left gondolyn-footer">
            <p class="raw-margin-left-20">&copy; {!! date('Y'); !!} <a href="https://yabhq.com">Yab</a></p>
        </div>
    </div>
@stop
