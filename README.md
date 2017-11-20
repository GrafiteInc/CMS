# Quarx - Add a CMS to any Laravel app to gain control of: pages, blogs, galleries, events, custom modules, images and more.

[![Build Status](https://travis-ci.org/YABhq/Quarx.svg?branch=master)](https://travis-ci.org/YABhq/Quarx)
[![Packagist](https://img.shields.io/packagist/dt/yab/quarx.svg?maxAge=2592000)](https://packagist.org/packages/yab/quarx)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://packagist.org/packages/yab/quarx)

Quarx is a full fledged CMS that can be added to any Laravel application. It provides you with full control of things like: pages, menus, links, widgets, blogs, events, faqs etc.

Quarx comes with a module builder for all your custom CMS needs, as well as a module publishing tools. So if you decide to reuse some modules on future projects you can easily publish thier assets seamlessly. If you wish to make your Quarx module into a PHP package, then you will need to have it publish its assets to the `quarx/modules` directory.

### What is simple vs complex setup?
Simple setup uses Laracogs as the backbone of an app for you using Laravel, once the setup command has been run you will have a full CMS as an app. Complex setup is specifically for developers who want to add a CMS to their existing app.

## Documentation
[http://quarxcms.com](http://quarxcms.com)

## Yab Newsletter
[Subscribe](http://eepurl.com/ck7dSv)

## Chat Support
[Gitter](https://gitter.im/YABhq/Quarx)

## Requirements
1. PHP 7+
1. MySQL 5.6+
2. OpenSSL

## Recommended
1. MySQL 5.7+

## Compatibility Guide

| Laravel Version | Package Tag | Supported |
|-----------------|-------------|-----------|
| 5.5.x | 2.4.x | yes |
| 5.4.x | 2.3.x | no |
| 5.3.x | 2.0.x - 2.2.x | no |
| 5.1.x - 5.2.x | 1.4.x | no |

## Installation

Create a new Laravel application, and make a database somewhere and update the .env file.

* Run the following command:

```bash
composer require yab/quarx
```

* Add the following to your Providers array in your config/app.php file:

```php
Yab\Quarx\QuarxProvider::class,
```

* Then run the vendor publish:

```bash
php artisan vendor:publish --provider="Yab\Quarx\QuarxProvider"
```

> Set your app's timezone config to align the Quarx datepicker UI for your setup

## Simple Setup

If you're looking to do a simple website with a powerful CMS, and the only people logging on to the app are the CMS managers. Then you can run the setup command.
Quarx will install everything it needs, run its migrations and give you a login to start with. Take control of your website in seconds.

```php
php artisan quarx:setup
```

Setup is now complete. Login, and start building your amazing new website!

## Complex Setup

If you just want to add Quarx to your existing application the follow these steps:

1. Update your routes provider (app/Providers/RouteServiceProvider.php) by changing the following:

```php
->group(base_path('routes/web.php'));
```

Into:

```php
->group(function() {
    require base_path('routes/web.php');
    require base_path('routes/quarx.php');
});
```

2. Add the following to your app.scss file, you will want to modify depending on your theme of choice.

```css
@import "resources/themes/default/assets/sass/_theme.scss";
```

* Run storage link is set for images & file uploads to work

```bash
php artisan storage:link
```

3. Then migrate:

```bash
php artisan migrate
```

4. Add to the Kernel Route Middleware:

```php
'quarx' => \App\Http\Middleware\Quarx::class,
'quarx-api' => \App\Http\Middleware\QuarxApi::class,
'quarx-language' => \App\Http\Middleware\QuarxLanguage::class,
'quarx-analytics' => \Yab\Quarx\Middleware\QuarxAnalytics::class,
```

5. In order to have modules load as well please add the following to your composer file under autoload psr-4 object:

```php
"Quarx\\": "quarx/",
```

This should be added to the autoloader below the App itself.

## Quarx Access
Route to the administration dashboard is "/quarx/dashboard".

Quarx requires Laracogs to run (only for the FormMaker), but Quarx does not require you to use the Laracogs version of roles. But you will still need to ensure some degree of control for Quarx's access. This is done in the Quarx Middleware, using the gate and the Quarx Policy. If you opt in to the roles system provided by Laracogs, then you can replace 'quarx' with admin to handle the Quarx authorization, if not, you will need to set your own security policy for access to Quarx. To do this simply add the Quarx policy to your `app/Providers/AuthServiceProvider.php` file, and ensure that any rules you wish it to use are in within the policy method. We suggest a policy similar to below.

Possible Quarx Policy:
```
Gate::define('quarx-api', function ($user) {
    return true;
});

Gate::define('quarx', function ($user) {
    return (bool) $user;
});
```

Or Using Laracogs:
```
Gate::define('quarx', function ($user) {
    return ($user->roles->first()->name === 'admin');
});
```

### Fun Route Trick

If you're looking for clean URL pages without having to have the URL preceed with `page` or `p` then you can
add this to your routes.

> Make sure you put it at the bottom of the routes or it may conflict with others.

```php
Route::get('{url}', function ($url) {
    return app(App\Http\Controllers\Quarx\PagesController::class)->show($url);
})->where('url', '([A-z\d-\/_.]+)?');
```

### Roles & Permissions (simple setup only)

With the roles middleware you can specify which roles are applicable separating them with pipes: `['middleware' => ['roles:admin|moderator|member']]`.

The Quarx middleware utilizes the roles to ensure that a user is an 'admin'. But you can elaborate on this substantially, you can create multiple roles, and then set their access in your app, using the roles middleware. But, what happens when you want to allow multiple roles to access Quarx but only allow Admins to access your custom modules? You can use permissions for this. Similar to the roles middleware you can set the permissions `['middleware' => ['permissions:admin|quarx']]`. You can set custom permissions in `config/permissions.php`. This means you can set different role permissions for parts of your CMS, giving you even more control.

## API Endpoints

Quarx comes with a collection of handy API endpoints if you wish to use them. You can define your own policies for access and customize the middleware as you see fit.

#### Token

The basic Quarx API endpoints must carry the Quarx `apiToken` defined in the config for the app. This can be provided by adding the following to any request:

```
?token={your token}
```

** All published and public facing data will be available via the API by default.

```
/quarx/api/blog
/quarx/api/blog/{id}
/quarx/api/events
/quarx/api/events/{id}
/quarx/api/faqs
/quarx/api/faqs/{id}
/quarx/api/files
/quarx/api/files/{id}
/quarx/api/images
/quarx/api/images/{id}
/quarx/api/pages
/quarx/api/pages/{id}
/quarx/api/widgets
/quarx/api/widgets/{id}
```

## Images

Images are resized on upload for a better quality response time. They follow the guidelines specified in the `config` under `quarx.max-image-size`.

## S3

Regarding S3 bucket usage. You will need to set the permissions accordingly to allow images to be saved to your buckets. Then you need to set your buckets to allow public viewing access.
This is an example of such a policy.

```
{
    "Version":"2008-10-17",
    "Statement":[{
        "Sid":"AllowPublicRead",
        "Effect":"Allow",
        "Principal": {
            "AWS": "*"
        },
        "Action":["s3:GetObject"],
        "Resource":["arn:aws:s3:::MY_BUCKET/public/images/*"]
    }]
}
```

Replace `MY_BUCKET` with your bucket name.

#### FileSystem Config

If using S3 you will need to add the following line to your filesystem config: `'visibility' => 'public',`

## License

Quarx is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Bug Reporting and Feature Requests

Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
