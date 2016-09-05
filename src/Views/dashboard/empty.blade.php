@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header text-center">Dashboard</h1>

                <p>The Quarx dashboard is powered by Google Analytics. By following the directions below, you will enable the Google Analytics charts and data sets on your dashboard.</p>

                <p>First run:</p>
<pre>
php artisan vendor:publish
</pre>

                <p>Once you've run that command you will need to edit the following file: <code>config/laravel-analytics.php</code>. To do that please follow the directions below:</p>
                <br>
                <h4 class="text-center">How to obtain the credentials to communicate with Google Analytics</h4>
                <br>
                <h5>Step 1:</h5>
                <hr>
                <p>If you haven't already done so, <a href="https://support.google.com/analytics/answer/1042508">set up a Google Analtyics property</a> and <a href="https://support.google.com/analytics/answer/1008080?hl=en#GA">install the tracking code on your site</a>.</p>

                <br>
                <h5>Step 2:</h5>
                <hr>
                <p>Follow the installation guide for <a href="https://github.com/spatie/laravel-analytics#how-to-obtain-the-credentials-to-communicate-with-google-analytics">laravel-analytics</a></p>

                <h5>Step 3:</h5>
                <hr>
                <p>Please add the following lines to your <code>.env</code> file.</p>
<pre>
ANALYTICS_VIEW_ID=ga:&lt;View ID&gt;
</pre>
        </div>
    </div>

@stop
