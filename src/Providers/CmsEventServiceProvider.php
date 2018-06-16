<?php

namespace Grafite\Cms\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CmsEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: Grafite\Cms\Models\Blog' => [
            'Grafite\Cms\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Grafite\Cms\Models\Page' => [
            'Grafite\Cms\Models\Page@afterSaved',
        ],
        'eloquent.saved: Grafite\Cms\Models\Event' => [
            'Grafite\Cms\Models\Event@afterSaved',
        ],
        'eloquent.saved: Grafite\Cms\Models\FAQ' => [
            'Grafite\Cms\Models\FAQ@afterSaved',
        ],
        'eloquent.saved: Grafite\Cms\Models\Translation' => [
            'Grafite\Cms\Models\Translation@afterSaved',
        ],
        'eloquent.saved: Grafite\Cms\Models\Widget' => [
            'Grafite\Cms\Models\Widget@afterSaved',
        ],

        'eloquent.created: Grafite\Cms\Models\Blog' => [
            'Grafite\Cms\Models\Blog@afterCreate',
        ],
        'eloquent.created: Grafite\Cms\Models\Page' => [
            'Grafite\Cms\Models\Page@afterCreate',
        ],
        'eloquent.created: Grafite\Cms\Models\Event' => [
            'Grafite\Cms\Models\Event@afterCreate',
        ],
        'eloquent.created: Grafite\Cms\Models\FAQ' => [
            'Grafite\Cms\Models\Event@afterCreate',
        ],
        'eloquent.created: Grafite\Cms\Models\Widget' => [
            'Grafite\Cms\Models\Widget@afterCreate',
        ],
        'eloquent.created: Grafite\Cms\Models\Link' => [
            'Grafite\Cms\Models\Link@afterCreate',
        ],

        'eloquent.deleting: Grafite\Cms\Models\Blog' => [
            'Grafite\Cms\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Cms\Models\Page' => [
            'Grafite\Cms\Models\Page@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Cms\Models\Event' => [
            'Grafite\Cms\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Cms\Models\FAQ' => [
            'Grafite\Cms\Models\FAQ@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Cms\Models\Translation' => [
            'Grafite\Cms\Models\Translation@beingDeleted',
        ],
        'eloquent.deleting: Grafite\Cms\Models\Widget' => [
            'Grafite\Cms\Models\Widget@beingDeleted',
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
