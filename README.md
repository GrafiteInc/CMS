# Quarx - Add a CMS to any Laravel app to gain control of: pages, blogs, galleries, events, custom modules, images and more.

[![Codeship](https://img.shields.io/codeship/8bf4be00-a7c3-0133-9b26-721682b6b155.svg)](https://packagist.org/packages/yab/quarx)
[![Packagist](https://img.shields.io/packagist/dt/yab/quarx.svg?maxAge=2592000)](https://packagist.org/packages/yab/quarx)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://packagist.org/packages/yab/quarx)

Quarx is a full fledged CMS that can be added to any Laravel application. It provides you with full control of things like: pages, menus, links, widgets, blogs, events, faqs etc.

Quarx comes with a module builder for all your custom CMS needs, as well as a module publishing tools. So if you decide to reuse some modules on future projects you can easily publish thier assets seamlessly. If you wish to make your Quarx module into a PHP package, then you will need to have it publish its assets to the `quarx/modules` directory.

## Documentation
[http://quarx.info](http://quarx.info)

## Requirements

1. PHP 5.6+
2. OpenSSL
3. Laravel 5.1 - 5.2 (v1.4.*)

## Installation

Create a new Laravel application, and make a database somewhere and update the .env file.

* Run the following command:

```bash
composer require yab/quarx
```

* Add the following to your Providers:

```php
Yab\Quarx\QuarxProvider::class
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
require app_path('Http/quarx-routes.php');
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
$gate->define('quarx', function ($user) {
    return (bool) $user;
});
```

Or Using Laracogs:
```
$gate->define('quarx', function ($user) {
    return ($user->roles->first()->name === 'admin');
});
```

## License

Quarx is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Bug Reporting and Feature Requests

Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
