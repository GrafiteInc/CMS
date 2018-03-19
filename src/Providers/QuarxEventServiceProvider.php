<?php

namespace graphite\Quarx\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class QuarxEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: graphite\Quarx\Models\Blog' => [
            'graphite\Quarx\Models\Blog@afterSaved',
        ],
        'eloquent.saved: graphite\Quarx\Models\Page' => [
            'graphite\Quarx\Models\Page@afterSaved',
        ],
        'eloquent.saved: graphite\Quarx\Models\Event' => [
            'graphite\Quarx\Models\Event@afterSaved',
        ],
        'eloquent.saved: graphite\Quarx\Models\FAQ' => [
            'graphite\Quarx\Models\FAQ@afterSaved',
        ],
        'eloquent.saved: graphite\Quarx\Models\Translation' => [
            'graphite\Quarx\Models\Translation@afterSaved',
        ],
        'eloquent.saved: graphite\Quarx\Models\Widget' => [
            'graphite\Quarx\Models\Widget@afterSaved',
        ],

        'eloquent.created: graphite\Quarx\Models\Blog' => [
            'graphite\Quarx\Models\Blog@afterCreate',
        ],
        'eloquent.created: graphite\Quarx\Models\Page' => [
            'graphite\Quarx\Models\Page@afterCreate',
        ],
        'eloquent.created: graphite\Quarx\Models\Event' => [
            'graphite\Quarx\Models\Event@afterCreate',
        ],
        'eloquent.created: graphite\Quarx\Models\FAQ' => [
            'graphite\Quarx\Models\Event@afterCreate',
        ],
        'eloquent.created: graphite\Quarx\Models\Widget' => [
            'graphite\Quarx\Models\Widget@afterCreate',
        ],

        'eloquent.deleting: graphite\Quarx\Models\Blog' => [
            'graphite\Quarx\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: graphite\Quarx\Models\Page' => [
            'graphite\Quarx\Models\Page@beingDeleted',
        ],
        'eloquent.deleting: graphite\Quarx\Models\Event' => [
            'graphite\Quarx\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: graphite\Quarx\Models\FAQ' => [
            'graphite\Quarx\Models\FAQ@beingDeleted',
        ],
        'eloquent.deleting: graphite\Quarx\Models\Translation' => [
            'graphite\Quarx\Models\Translation@beingDeleted',
        ],
        'eloquent.deleting: graphite\Quarx\Models\Widget' => [
            'graphite\Quarx\Models\Widget@beingDeleted',
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
