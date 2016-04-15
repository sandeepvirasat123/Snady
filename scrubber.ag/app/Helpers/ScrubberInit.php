<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 4/7/2016
 * Time: 1:46 AM
 */

namespace App\Helpers;

use App\Helpers\Contracts\ScrubberBaseContract;
use Illuminate\Http\Request;

class ScrubberInit implements ScrubberBaseContract  {
    public $site = null;
    public $token = null;
    public $direction = null;
    public $action = null;
    public $scrubbers = null;
    public $scrubberTypes = null;
    public $temp = null;

    protected $filtered = false;

    public function __construct(Request $request) {
        $this->site = apache_request_headers()['Host'];
        $this->token = $request->id;
        $this->direction = $request->direction;
        $this->action = $request->action;
        $this->scrubbers = $request->scrubber;
        $this->scrubberTypes = $request->scrubberType;

        //this is temporary code... How to tell if it's a call from a scrubber or from local network?
        if ($this->token != null && $this->direction == null) {
            $this->direction = "request";
        }

        //this is temporary code... How to tell if it's a call from a scrubber or from local network?
        if ($this->token != null && $this->action == null) {
            $this->action = "new";
        }

        $pattern = '/,(\s+)/i';

        //cleanup and convert into array "scrubbers"
        if ($this->scrubbers != null) {
            $this->scrubbers = preg_replace($pattern, ",", $this->scrubbers);
            $this->scrubbers = explode(",", $this->scrubbers);
        }

        //cleanup and convert into array "scrubberTypes"
        if ($this->scrubberTypes == null) {
            $this->scrubberTypes = "full, person, device, card, check, wallet";
        }
        $this->scrubberTypes = preg_replace($pattern, ",", $this->scrubberTypes);
        $this->scrubberTypes = explode(",", $this->scrubberTypes);
    }

    public function getInstance() {
        return $this;
    }

    public function scrubberFilter() {
        //echo (app()->offsetExists('objScrubbers'));
        //dd(app()->offsetExists('objScrubbers'));
        //dd(app()['objScrubbers']);
        if (app()->bound("objScrubbers")) {
            if ($this->scrubbers == null) {
                $this->scrubbers = app()['objScrubbers']->scrubberPlugins;
                $this->filtered = true;
            } else {
                $top = count($this->scrubbers);
                for ($i = 0; $i < $top; $i++) {
                    if ($top > $i && !in_array($this->scrubbers[$i], app()['objScrubbers']->scrubberPlugins)) {
                        unset($this->scrubbers[$i]);
                    }
                }
                $this->filtered = true;
            }
        }

        return $this->filtered;
    }

    public function scrubberAvailable() {
        if (!$this->filtered) {
            $this->scrubberFilter();
        }

        return count($this->scrubbers) > 0;
    }

}