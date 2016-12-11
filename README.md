# Quarx - Add a CMS to any Laravel app to gain control of: pages, blogs, galleries, events, custom modules, images and more.

[![Codeship](https://img.shields.io/codeship/8bf4be00-a7c3-0133-9b26-721682b6b155.svg)](https://packagist.org/packages/yab/quarx)
[![Packagist](https://img.shields.io/packagist/dt/yab/quarx.svg?maxAge=2592000)](https://packagist.org/packages/yab/quarx)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://packagist.org/packages/yab/quarx)

Quarx is a full fledged CMS that can be added to any Laravel application. It provides you with full control of things like: pages, menus, links, widgets, blogs, events, faqs etc.

Quarx comes with a module builder for all your custom CMS needs, as well as a module publishing tools. So if you decide to reuse some modules on future projects you can easily publish thier assets seamlessly. If you wish to make your Quarx module into a PHP package, then you will need to have it publish its assets to the `quarx/modules` directory.

### What is simple vs complex setup?
Simple setup uses Laracogs as the backbone of an app for you using Laravel, once the setup command has been run you will have a full CMS as an app. Complex setup is specifically for developers who want to add a CMS to their existing app.

## Documentation
[http://quarx.info](http://quarx.info)

## Yab Newsletter
[Subscribe](http://eepurl.com/ck7dSv)

## Requirements
1. PHP 5.6+
1. MySQL 5.6+
2. OpenSSL
3. Laravel 5.1 - 5.2 (v1.4.*)
3. Laravel 5.3 (v2.0.*)

## Recommended
1. PHP 7+
1. MySQL 5.7+
3. Laravel 5.3

## Installation

Create a new Laravel application, and make a database somewhere and update the .env file.

* Run the following command:

```bash
composer require yab/quarx
```

* Add the following to your Providers:

```php
Yab\Quarx\QuarxProvider::class,
```

* Then run the vendor publish:

```bash
php artisan vendor:publish --provider="Yab\Quarx\QuarxProvider"
```

## Simple Setup

If you're looking to do a simple website with a powerful CMS, and the only people logging on to the app are the CMS managers. Then you can run the setup command.
Quarx will install everything it needs, run its migrations and give you a login to start with. Take control of your website in seconds.

```php
php artisan quarx:setup
```

Now your done setup. Login, and start building your amazing new website!

## Complex Setup

If you just want to add Quarx to your existing application and already have your own

* Add the following to your routes provider:

```php
require base_path('routes/quarx.php');
```

* Add the following to your app.scss file, you will want to modify depending on your theme of choice.

```css
@import "resources/themes/default/assets/sass/_theme.scss";
```

* Then migrate:

```bash
php artisan migrate
```

* Then add to the Kernel Route Middleware:

```php
'quarx' => \App\Http\Middleware\Quarx::class,
'quarx-api' => \App\Http\Middleware\QuarxApi::class,
'quarx-language' => \App\Http\Middleware\QuarxLanguage::class,
```

In order to have modules load as well please add the following to your composer file:
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

## License

Quarx is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Bug Reporting and Feature Requests

Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
