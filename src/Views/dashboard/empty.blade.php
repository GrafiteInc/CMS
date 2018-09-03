@extends('cms::layouts.dashboard')

@section('pageTitle') Dashboard @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <p>The Cms dashboard is powered by <b>Google Analytics</b> or by its own <b>Internal Analytics</b>.</p>

                <h3>Internal Analytics</h3>
                <p>In order to use the internal analytics (just for this dashboard - you can still add your Google Analytics tracking to the site) simply run:</p>
<pre>
php artisan migrate
</pre>

                <h3>Google Analytics</h3>
                <p>Grafite CMS uses the Spatie package for Google Analytics integration. <br><br>Please follow its installation instructions: <a target="_blank" href="https://github.com/spatie/laravel-analytics#installation">https://github.com/spatie/laravel-analytics#installation</a></p>
        </div>
    </div>

@stop
