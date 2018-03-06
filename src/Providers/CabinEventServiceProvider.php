<?php

namespace Yab\Cabin\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CabinEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: Yab\Cabin\Models\Blog' => [
            'Yab\Cabin\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Yab\Cabin\Models\Page' => [
            'Yab\Cabin\Models\Page@afterSaved',
        ],
        'eloquent.saved: Yab\Cabin\Models\Event' => [
            'Yab\Cabin\Models\Event@afterSaved',
        ],
        'eloquent.saved: Yab\Cabin\Models\FAQ' => [
            'Yab\Cabin\Models\FAQ@afterSaved',
        ],
        'eloquent.saved: Yab\Cabin\Models\Translation' => [
            'Yab\Cabin\Models\Translation@afterSaved',
        ],
        'eloquent.saved: Yab\Cabin\Models\Widget' => [
            'Yab\Cabin\Models\Widget@afterSaved',
        ],

        'eloquent.created: Yab\Cabin\Models\Blog' => [
            'Yab\Cabin\Models\Blog@afterCreate',
        ],
        'eloquent.created: Yab\Cabin\Models\Page' => [
            'Yab\Cabin\Models\Page@afterCreate',
        ],
        'eloquent.created: Yab\Cabin\Models\Event' => [
            'Yab\Cabin\Models\Event@afterCreate',
        ],
        'eloquent.created: Yab\Cabin\Models\FAQ' => [
            'Yab\Cabin\Models\Event@afterCreate',
        ],
        'eloquent.created: Yab\Cabin\Models\Widget' => [
            'Yab\Cabin\Models\Widget@afterCreate',
        ],

        'eloquent.deleting: Yab\Cabin\Models\Blog' => [
            'Yab\Cabin\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: Yab\Cabin\Models\Page' => [
            'Yab\Cabin\Models\Page@beingDeleted',
        ],
        'eloquent.deleting: Yab\Cabin\Models\Event' => [
            'Yab\Cabin\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Yab\Cabin\Models\FAQ' => [
            'Yab\Cabin\Models\FAQ@beingDeleted',
        ],
        'eloquent.deleting: Yab\Cabin\Models\Translation' => [
            'Yab\Cabin\Models\Translation@beingDeleted',
        ],
        'eloquent.deleting: Yab\Cabin\Models\Widget' => [
            'Yab\Cabin\Models\Widget@beingDeleted',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot()
    {
        parent::boot();
    }
}
