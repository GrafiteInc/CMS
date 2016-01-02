<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Quarx</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <style type="text/css">
            body { padding-top: 70px; padding-bottom: 70px; }
        </style>
        @yield('stylesheets')
    </head>

    <body>

        <div class="navbar navbar-default navbar-fixed-top clearfix">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('') }}">Home</a>
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('blog') }}">Blog</a></li>
                        <li><a href="{{ url('page') }}">Pages</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            @yield('content')
        </div>

         <div class="container-fluid navbar-fixed-bottom">
            <p>&copy; {{ date('Y') }}</p>
        </div>

    </body>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        var _url = '{!! url('') !!}';
    </script>
    @yield('javascript')
</html>
