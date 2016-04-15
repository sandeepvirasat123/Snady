<?php

namespace App\Listeners;

use Log;
use App\Events\ScrubberResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScrubberResponseListener
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
     * @param  ScrubberResponse  $event
     * @return void
     */
    public function handle(ScrubberResponse $event)
    {
        Log::debug($event->getMessage());
    }
}
