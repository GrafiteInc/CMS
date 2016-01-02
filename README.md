# Quarx - A CMS for Laravel apps

## Installation

* Run the following command:

```bash
composer require mlantz/quarx
```

* Add the following to your Providers:

```php
Mlantz\Quarx\QuarxProvider::class
```

* Then migrate:

```bash
php artisan quarx:migrate
```

* Then run the vendor publish:

```bash
php artisan vendor:publish --provider="Mlantz\Quarx\QuarxProvider"
```

* Then add to the Kernal:

```php
'quarx' => \App\Http\Middleware\Quarx::class,
```

## Quarx Access

Quarx requires Laracogs to run (only for the FormMaker), but Laracogs does not require you to use its version of roles. But you will still need to ensure some degree of control for Quarx's access. This is done in the Quarx Middleware. If you opt in to the roles system provided by Laracogs, then you can use the logic below in your Quarx Middleware, if not, you will need to set your own security parameters for access to Quarx. To do this simply edit the Quarx middleware, and ensure that any rules you wish it to use are in the `handler` method. We suggest a policy similar to the following:

Admin Policy:
```
$gate->define('admin', function ($user) {
    return ($user->roles->first()->name === 'admin');
});
```

Quarx Middleware Handler:
```
public function handle($request, Closure $next)
{
    if (Gate::allows('admin', $this->auth->user())) {
        return $next($request);
    }

    return response('Unauthorized.', 401);
}
```
