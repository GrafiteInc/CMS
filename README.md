# Quarx - A CMS for Laravel apps

## Installation

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

Quarx requires Laracogs to run (only for the FormMaker), but Laracogs does not require you to use its version of roles. But you will still need to ensure some degree of control for Quarx's access. This is done in the Quarx Middleware, using the gate and the Quarx Policy. If you opt in to the roles system provided by Laracogs, then you can replace 'quarx' with admin to handle the Quarx authorization, if not, you will need to set your own security policy for access to Quarx. To do this simply add the Quarx policy to your `app/Providers/AuthServiceProvider.php` file, and ensure that any rules you wish it to use are in within the policy method. We suggest a policy similar to below.

Quarx Policy:
```
$gate->define('quarx', function ($user) {
    return (bool) $user;
});
```

Using Laracogs:
```
$gate->define('quarx', function ($user) {
    return ($user->roles->first()->name === 'admin');
});
```
