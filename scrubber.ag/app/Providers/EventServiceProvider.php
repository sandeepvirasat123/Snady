<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],

        'App\Events\ScrubberRequest' => [
            'App\Listeners\ScrubberRequestListener',
        ],

        'App\Events\ScrubberResponse' => [
            'App\Listeners\ScrubberResponseListener',
        ],

        'App\Events\ScrubberScrubberFail' => [
            'App\Listeners\ScrubberScrubberFailListener',
        ],

        'App\Events\ScrubberScrubberRequest' => [
            'App\Listeners\ScrubberScrubberRequestListener',
        ],

        'App\Events\ScrubberScrubberResponse' => [
            'App\Listeners\ScrubberScrubberResponseListener',
        ],

        'App\Events\ScrubberScrubberResponseParsed' => [
            'App\Listeners\ScrubberScrubberResponseParsedListener',
        ],

        'App\Events\ScrubberJournalNew' => [
            'App\Listeners\ScrubberJournalNewListener',
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
