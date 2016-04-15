<?php

namespace App\Listeners;

use Log;
use App\Events\ScrubberScrubberResponseParsed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScrubberScrubberResponseParsedListener
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
     * @param  ScrubberScrubberResponseParsed  $event
     * @return void
     */
    public function handle(ScrubberScrubberResponseParsed $event)
    {
        Log::debug($event->getMessage());
    }
}
