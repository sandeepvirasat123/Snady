<?php

namespace App\Listeners;

use Log;
use App\Events\ScrubberScrubberRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScrubberScrubberRequestListener
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
     * @param  ScrubberScrubberRequest  $event
     * @return void
     */
    public function handle(ScrubberScrubberRequest $event)
    {
        Log::debug($event->getMessage());
    }
}
