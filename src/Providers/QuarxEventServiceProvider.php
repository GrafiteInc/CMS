<?php

namespace Yab\Quarx\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class QuarxEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: Yab\Quarx\Models\Blog' => [
            'Yab\Quarx\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Yab\Quarx\Models\Page' => [
            'Yab\Quarx\Models\Page@afterSaved',
        ],
        'eloquent.saved: Yab\Quarx\Models\Event' => [
            'Yab\Quarx\Models\Event@afterSaved',
        ],
        'eloquent.saved: Yab\Quarx\Models\FAQ' => [
            'Yab\Quarx\Models\FAQ@afterSaved',
        ],
        'eloquent.saved: Yab\Quarx\Models\Translation' => [
            'Yab\Quarx\Models\Translation@afterSaved',
        ],
        'eloquent.saved: Yab\Quarx\Models\Widget' => [
            'Yab\Quarx\Models\Widget@afterSaved',
        ],

        'eloquent.created: Yab\Quarx\Models\Blog' => [
            'Yab\Quarx\Models\Blog@afterCreate',
        ],
        'eloquent.created: Yab\Quarx\Models\Page' => [
            'Yab\Quarx\Models\Page@afterCreate',
        ],
        'eloquent.created: Yab\Quarx\Models\Event' => [
            'Yab\Quarx\Models\Event@afterCreate',
        ],
        'eloquent.created: Yab\Quarx\Models\FAQ' => [
            'Yab\Quarx\Models\Event@afterCreate',
        ],
        'eloquent.created: Yab\Quarx\Models\Widget' => [
            'Yab\Quarx\Models\Widget@afterCreate',
        ],

        'eloquent.deleting: Yab\Quarx\Models\Blog' => [
            'Yab\Quarx\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: Yab\Quarx\Models\Page' => [
            'Yab\Quarx\Models\Page@beingDeleted',
        ],
        'eloquent.deleting: Yab\Quarx\Models\Event' => [
            'Yab\Quarx\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Yab\Quarx\Models\FAQ' => [
            'Yab\Quarx\Models\FAQ@beingDeleted',
        ],
        'eloquent.deleting: Yab\Quarx\Models\Translation' => [
            'Yab\Quarx\Models\Translation@beingDeleted',
        ],
        'eloquent.deleting: Yab\Quarx\Models\Widget' => [
            'Yab\Quarx\Models\Widget@beingDeleted',
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
