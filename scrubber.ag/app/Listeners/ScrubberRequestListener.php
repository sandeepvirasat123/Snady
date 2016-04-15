<?php

namespace App\Listeners;

use Log;
use App\Events\ScrubberRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScrubberRequestListener
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
     * @param  ScrubberRequest  $event
     * @return void
     */
    public function handle(ScrubberRequest $event)
    {
        Log::debug($event->getMessage());
    }
}
