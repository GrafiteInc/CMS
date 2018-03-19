# Cabin - Add a CMS to any Laravel app to gain control of: pages, blogs, galleries, events, custom modules, images and more.

[![Build Status](https://travis-ci.org/YABhq/Cabin.svg?branch=master)](https://travis-ci.org/YABhq/Cabin)
[![Packagist](https://img.shields.io/packagist/dt/yab/cabin.svg?maxAge=2592000)](https://packagist.org/packages/yab/cabin)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://packagist.org/packages/yab/cabin)

Cabin is a full fledged CMS that can be added to any Laravel application. It provides you with full control of things like: pages, menus, links, widgets, blogs, events, faqs etc.

Cabin comes with a module builder for all your custom CMS needs, as well as a module publishing tools. So if you decide to reuse some modules on future projects you can easily publish thier assets seamlessly. If you wish to make your Cabin module into a PHP package, then you will need to have it publish its assets to the `cabin/modules` directory.

### What is simple vs complex setup?
Simple setup uses Laracogs as the backbone of an app for you using Laravel, once the setup command has been run you will have a full CMS as an app. Complex setup is specifically for developers who want to add a CMS to their existing app.

## Documentation
[http://cabincms.com](http://cabincms.com)

## Yab Newsletter
[Subscribe](http://eepurl.com/ck7dSv)

## Chat Support
[Gitter](https://gitter.im/YABhq/Cabin)

## Requirements
1. PHP 7+
1. MySQL 5.7+
2. OpenSSL

## Compatibility Guide

| Laravel Version | Package Tag | Supported |
|-----------------|-------------|-----------|
| 5.6.x | 2.5.x | yes |
| 5.5.x | 2.4.x | no |
| 5.4.x | 2.3.x | no |

## Installation

Create a new Laravel application, and make a database somewhere and update the .env file.

* Run the following command:

```bash
composer require yab/cabin
```

* Add the following to your Providers array in your config/app.php file:

```php
Grafite\Cms\CabinProvider::class,
```

* Then run the vendor publish:

```bash
php artisan vendor:publish --provider="Grafite\Cms\CabinProvider"
```

> Set your app's timezone config to align the Cabin datepicker UI for your setup

## Upgrade Guide from 2.4.x to 2.5.x

There is no simple way around it, due to a rebranding of the package you have to check your app for anything with the name `Quarx` or `quarx` and switch it to `Cabin` and `cabin`.
Outside of that you need to switch to Laravel 5.6.

## Simple Setup

If you're looking to do a simple website with a powerful CMS, and the only people logging on to the app are the CMS managers. Then you can run the setup command.
Cabin will install everything it needs, run its migrations and give you a login to start with. Take control of your website in seconds.

```php
php artisan cabin:setup
```

Setup is now complete. Login, and start building your amazing new website!

## Complex Setup

If you just want to add Cabin to your existing application the follow these steps:

1. Update your routes provider (app/Providers/RouteServiceProvider.php) by changing the following:

```php
->group(base_path('routes/web.php'));
```

Into:

```php
->group(function() {
    require base_path('routes/web.php');
    require base_path('routes/cabin.php');
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
'cabin' => \App\Http\Middleware\Cabin::class,
'cabin-api' => \App\Http\Middleware\CabinApi::class,
'cabin-language' => \App\Http\Middleware\CabinLanguage::class,
'cabin-analytics' => \Grafite\Cms\Middleware\CabinAnalytics::class,
```

5. In order to have modules load as well please add the following to your composer file under autoload psr-4 object:

```php
"Cabin\\": "cabin/",
```

This should be added to the autoloader below the App itself.

## Cabin Access
Route to the administration dashboard is "/cabin/dashboard".

Cabin requires Laracogs to run (only for the FormMaker), but Cabin does not require you to use the Laracogs version of roles. But you will still need to ensure some degree of control for Cabin's access. This is done in the Cabin Middleware, using the gate and the Cabin Policy. If you opt in to the roles system provided by Laracogs, then you can replace 'cabin' with admin to handle the Cabin authorization, if not, you will need to set your own security policy for access to Cabin. To do this simply add the Cabin policy to your `app/Providers/AuthServiceProvider.php` file, and ensure that any rules you wish it to use are in within the policy method. We suggest a policy similar to below.

Possible Cabin Policy:
```
Gate::define('cabin-api', function ($user) {
    return true;
});

Gate::define('cabin', function ($user) {
    return (bool) $user;
});
```

Or Using Laracogs:
```
Gate::define('cabin', function ($user) {
    return ($user->roles->first()->name === 'admin');
});
```

### Fun Route Trick

If you're looking for clean URL pages without having to have the URL preceed with `page` or `p` then you can
add this to your routes.

> Make sure you put it at the bottom of the routes or it may conflict with others.

```php
Route::get('{url}', function ($url) {
    return app(App\Http\Controllers\Cabin\PagesController::class)->show($url);
})->where('url', '([A-z\d-\/_.]+)?');
```

### Roles & Permissions (simple setup only)

With the roles middleware you can specify which roles are applicable separating them with pipes: `['middleware' => ['roles:admin|moderator|member']]`.

The Cabin middleware utilizes the roles to ensure that a user is an 'admin'. But you can elaborate on this substantially, you can create multiple roles, and then set their access in your app, using the roles middleware. But, what happens when you want to allow multiple roles to access Cabin but only allow Admins to access your custom modules? You can use permissions for this. Similar to the roles middleware you can set the permissions `['middleware' => ['permissions:admin|cabin']]`. You can set custom permissions in `config/permissions.php`. This means you can set different role permissions for parts of your CMS, giving you even more control.

## API Endpoints

Cabin comes with a collection of handy API endpoints if you wish to use them. You can define your own policies for access and customize the middleware as you see fit.

#### Token

The basic Cabin API endpoints must carry the Cabin `apiToken` defined in the config for the app. This can be provided by adding the following to any request:

```
?token={your token}
```

** All published and public facing data will be available via the API by default.

```
/cabin/api/blog
/cabin/api/blog/{id}
/cabin/api/events
/cabin/api/events/{id}
/cabin/api/faqs
/cabin/api/faqs/{id}
/cabin/api/files
/cabin/api/files/{id}
/cabin/api/images
/cabin/api/images/{id}
/cabin/api/pages
/cabin/api/pages/{id}
/cabin/api/widgets
/cabin/api/widgets/{id}
```

## Images

Images are resized on upload for a better quality response time. They follow the guidelines specified in the `config` under `cabin.max-image-size`.

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

Cabin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Bug Reporting and Feature Requests

Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
