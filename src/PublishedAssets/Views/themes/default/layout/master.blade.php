<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Website</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        @yield('stylesheets')
    </head>

    <body>

        @theme('partials.navigation')

        <div class="site-wrapper @if(Request::is('/')) homepage @endif">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <div class="footer container-fluid navbar-fixed-bottom">
            <p class="pull-left">&copy; {{ date('Y') }}</p>
            @can('quarx')
                <a class="btn btn-xs btn-default pull-right" href="{{ url('quarx/dashboard') }}">Quarx</a>
                @yield('quarx')
            @else
                <a class="btn btn-xs btn-default pull-right" href="{{ url('login') }}">Login</a>
            @endcan
        </div>

    </body>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
        var _url = '{!! url('') !!}';
    </script>
    @yield('javascript')
</html>
