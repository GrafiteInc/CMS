<!doctype html>

<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

        <title>{{ config('app.name') }} @if (isset($page) && !is_null($page->title)) - {{ $page->title }} @endif</title>

        <meta name="description" content="@yield('seoDescription')">
        <meta name="keywords" content="@yield('seoKeywords')">
        <meta name="author" content="">

        <meta property="og:title" content="@if (isset($page) && !is_null($page->title)) - {{ $page->title }} @endif">
        <meta property="og:description" content="@yield('seoDescription')">
        <meta property="og:image" content="">
        <meta property="og:url" content="">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        @yield('stylesheets')
    </head>

    <body>

        @theme('partials.navigation')

        <div class="site-wrapper @if (Request::is('/')) homepage @endif">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <div class="footer container-fluid navbar-fixed-bottom">
            <ul class="nav">
                <li class="nav-item">
                    <span class="nav-text">&copy; {{ date('Y') }}</span>
                </li>
                @can('cms')
                    <li class="nav-item"><a class="btn btn-sm btn-link" href="{{ url(config('cms.backend-route-prefix', 'cms').'/dashboard') }}">CMS</a></li>
                    @yield('cms')
                @else
                    <li class="nav-item"><a class="btn btn-sm btn-link" href="{{ url('login') }}">Login</a></li>
                @endcan
            </ul>
        </div>
    </body>

    <script type="text/javascript">
        var _token = '{!! csrf_token() !!}';
        var _url = '{!! url("/") !!}';
    </script>
    @yield("pre-javascript")
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @yield('javascript')
</html>
