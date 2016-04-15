<?php

namespace App\Listeners;

use Log;
use App\Events\ScrubberScrubberFail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScrubberScrubberFailListener
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
     * @param  ScrubberScrubberFail  $event
     * @return void
     */
    public function handle(ScrubberScrubberFail $event)
    {
        Log::debug($event->getMessage());
    }
}
