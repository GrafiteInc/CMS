<?php

namespace Mlantz\Quarx\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class QuarxEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: Mlantz\Quarx\Models\Blog' => [
            'Mlantz\Quarx\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Mlantz\Quarx\Models\Pages' => [
            'Mlantz\Quarx\Models\Pages@afterSaved',
        ],
        'eloquent.saved: Mlantz\Quarx\Models\Event' => [
            'Mlantz\Quarx\Models\Event@afterSaved',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
