@extends('cms::layouts.dashboard')

@section('pageTitle') Dashboard @stop

@section('content')

    <div class="row">
        <div class="col-md-12">
                <p>The Cms dashboard is powered by <b>Google Analytics</b> or by its own <b>Internal Analytics</b>.</p>

                <h3>Internal Analytics</h3>
                <p>In order to use the internal analytics (just for this dashboard - you can still add your Google Analytics tracking to the site) simply run:</p>
<pre>
php artisan migrate
</pre>

                <h3>Google Analytics</h3>
                <p>By following the directions below, you will enable the Google Analytics charts and data sets on your dashboard.</p>

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
                <p>You will need: <code>siteId</code>, <code>clientId</code> and <code>serviceEmail</code>. Additionally a <code>p12-file</code> is required.</p>
                <p>To obtain these credentials start by going to the <a href="https://console.developers.google.com">Google Developers Console</a>.</p>
                <p>If you don't have a project present in the console yet, create one.</p>
                <p>If you click on the project name, you'll see a menu item <code>APIs</code> under <code>APIs &amp; auth</code> on the left hand side. Click it to go the the Enabled API's screen. On that screen you should enable the Analytics API.</p>
                <p>Now, again under the <code>APIs &amp; Auth</code>-menu click <code>Credentials</code>.</p>
                <p>On this screen you should press <code>Create new Client ID</code>. In the creation screen make sure you select application type <code>Service Account</code> and key type <code>P12-key</code>.</p>

                <p>The creation of the Service Account generated a new public/private key pair and the <code>.p12-file</code> will get downloaded to your machine. Store this file in the location specified in the config file of this package.</p>

                <p>From the <code>Credentials</code> screen in Google Console. From there select the <a href="https://console.developers.google.com/permissions/serviceaccounts">'Manage service accounts'</a>. Within that screen, edit the service account you just made and select <code>Enable Google Apps Domain-wide Delegation</code> This will allow you to view the <code>client ID</code> where you can see the <code>client ID</code> and the <code>Client Email</code>.</p>

                <br>
                <h5>Step 3:</h5>
                <hr>
                <p>To find the right value for <code>siteId</code> log in to <a href="http://www.google.be/intl/en/analytics/">Google Analytics</a> go the the Admin section.</p>
                <p>In the property-column select the website name of which you want to retrieve data, then click <code>View Settings</code> in the <code>View</code>-column.</p>
                <p>The value presented as <code>View Id</code> prepended with 'ga:' can be used as <code>siteId</code>. You can see the 'ga:' example below.</p>

                <br>
                <h5>Notes:</h5>
                <hr>
                <p>For further information please follow these <a href="https://github.com/spatie/laravel-analytics">directions</a></p>

                <p>Please add the following lines to you <code>.env</code> file.</p>
<pre>
ANALYTICS_SITE_ID=ga:&lt;Site ID&gt;
ANALYTICS_CLIENT_ID=&lt;Client ID&gt;
ANALYTICS_SERVICE_EMAIL=&lt;Client Email&gt;
</pre>
        </div>
    </div>

@stop
