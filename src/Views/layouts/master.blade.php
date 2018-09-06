<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

        <title>{{ config('cms.backend-title') }}: {{ ucfirst(request()->segment(2)) }}</title>

        <link rel="icon" type="image/ico" href="{!! Cms::asset('images/favicon.ico', 'image/ico') !!}?v3">
        <link rel="icon" type="image/png" sizes="32x32" href="{!! Cms::asset('images/favicon-32.png', 'image/png') !!}?v3">
        <link rel="icon" type="image/png" sizes="96x96" href="{!! Cms::asset('images/favicon-96.png', 'image/png') !!}?v3">

        <!-- Bootstrap and Font-Awesome -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Theme -->
        <link rel="stylesheet" type="text/css" href="{!! Cms::asset('themes/'.config('cms.backend-theme', 'standard').'.css', 'text/css') !!}">

        <!-- App style -->
        <link rel="stylesheet" type="text/css" href="{!! Cms::asset('dist/css/vendor.css', 'text/css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! Cms::asset('dist/css/cms.css', 'text/css') !!}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        @yield('stylesheets')

        <script type="text/javascript">
            var _token = '{!! csrf_token() !!}';
            var _url = '{!! url("/") !!}';
            var _cms = '{!! cms()->url('/') !!}';
            var _pixabayKey = '{!! config('cms.pixabay', '') !!}';
            var _appTimeZone = '{!! config('app.timezone', 'UTC') !!}';
            var _apiKey = '{!! config("cms.api-key") !!}';
            var _apiToken = '{!! config("cms.api-token") !!}';
        </script>
    </head>
    <body>
        @include("cms::layouts.navigation")

        <div class="container-fluid">
            <div class="row">
                @yield("app-content")
            </div>
        </div>

        <script>
            @yield('pre_javascript')
        </script>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="{!! Cms::asset('dist/js/vendor.js', 'application/javascript') !!}"></script>
        <script src="{!! Cms::asset('dist/js/cms.js', 'application/javascript') !!}"></script>
        @include('cms::notifications')
        @yield("javascript")
    </body>
</html>