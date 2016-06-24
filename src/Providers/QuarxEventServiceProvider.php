<?php

namespace Yab\Quarx\Providers;

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
        'eloquent.saved: Yab\Quarx\Models\Blog' => [
            'Yab\Quarx\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Yab\Quarx\Models\Pages' => [
            'Yab\Quarx\Models\Pages@afterSaved',
        ],
        'eloquent.saved: Yab\Quarx\Models\Event' => [
            'Yab\Quarx\Models\Event@afterSaved',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
