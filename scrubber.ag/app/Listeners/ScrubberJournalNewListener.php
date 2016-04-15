<?php

namespace App\Listeners;

use App\Events\ScrubberJournalNew;
use App\Library\ScrubberJournalLib;
use App\Models\ScrubberJournal;
use App\Models\ScrubberScrubber;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScrubberJournalNewListener
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
     * @param  ScrubberJournalNew  $event
     * @return void
     */
    public function handle(ScrubberJournalNew $event)
    {
        $this->store();
    }


    public function store() {
        $scrubberJournal = new ScrubberJournal();
        app()->instance('objJournalLib', new ScrubberJournalLib());

        $scrubberJournal->year = date('Y');
        $scrubberJournal->month = date('m');
        $scrubberJournal->day = date('d');
        $scrubberJournal->description = app()['objProgress']->getScrubber();

        //foreign keys
        $scrubberJournal->header_id = app()['objHeaderLib']->id;
        $scrubberJournal->token_id = app()['objTokenLib']->id;

        $temp = ScrubberScrubber::ofScrubber(app()['objProgress']->getScrubber())->get();
        $id = null;
        if ($temp && count($temp) == 1) {
            $temp = $temp[0];
            if (isset($temp->id)) $id = $temp->id;
        }

        $scrubberJournal->scrubber_id = $id;

        $scrubberJournal->save();

        app()['objJournalLib']->id = $scrubberJournal->id;

    }

}
