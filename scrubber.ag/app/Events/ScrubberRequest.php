<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ScrubberRequest extends Event
{
    use SerializesModels;

    private $message;

    /**
     * Create a new event instance.
     *
     * @param  Podcast  $data
     * @return void
     */
    public function __construct($data)
    {
        $this->message = "Scrubber Request Started";
    }

    public function getMessage() {
        return $this->message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
