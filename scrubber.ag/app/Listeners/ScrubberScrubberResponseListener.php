<?php

namespace App\Listeners;

use Log;
use App\Events\ScrubberScrubberResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScrubberScrubberResponseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ScrubberScrubberResponse  $event
     * @return void
     */
    public function handle(ScrubberScrubberResponse $event)
    {
        Log::debug($event->getMessage());
    }
}
