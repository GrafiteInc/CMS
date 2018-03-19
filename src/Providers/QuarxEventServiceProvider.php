<?php

namespace Grafite\Quarx\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class QuarxEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: Grafite\Quarx\Models\Blog' => [
            'Grafite\Quarx\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Grafite\Quarx\Models\Page' => [
            'Grafite\Quarx\Models\Page@afterSaved',
        ],
        'eloquent.saved: Grafite\Quarx\Models\Event' => [
            'Grafite\Quarx\Models\Event@afterSaved',
        ],
        'eloquent.saved: Grafite\Quarx\Models\FAQ' => [
            'Grafite\Quarx\Models\FAQ@afterSaved',
        ],
        'eloquent.saved: Grafite\Quarx\Models\Translation' => [
            'Grafite\Quarx\Models\Translation@afterSaved',
        ],
        'eloquent.saved: Grafite\Quarx\Models\Widget' => [
            'Grafite\Quarx\Models\Widget@afterSaved',
        ],

        'eloquent.created: Grafite\Quarx\Models\Blog' => [
            'Grafite\Quarx\Models\Blog@afterCreate',
        ],
        'eloquent.created: Grafite\Quarx\Models\Page' => [
            'Grafite\Quarx\Models\Page@afterCreate',
        ],
        'eloquent.created: Grafite\Quarx\Models\Event' => [
            'Grafite\Quarx\Models\Event@afterCreate',
        ],
        'eloquent.created: Grafite\Quarx\Models\FAQ' => [
            'Grafite\Quarx\Models\Event@afterCreate',
        ],
        'eloquent.created: Grafite\Quarx\Models\Widget' => [
            'Grafite\Quarx\Models\Widget@afterCreate',
        ],

        'eloquent.deleting: Grafite\Quarx\Models\Blog' => [
            'Grafite\Quarx\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Quarx\Models\Page' => [
            'Grafite\Quarx\Models\Page@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Quarx\Models\Event' => [
            'Grafite\Quarx\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Quarx\Models\FAQ' => [
            'Grafite\Quarx\Models\FAQ@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Quarx\Models\Translation' => [
            'Grafite\Quarx\Models\Translation@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Quarx\Models\Widget' => [
            'Grafite\Quarx\Models\Widget@beingDeleted',
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
