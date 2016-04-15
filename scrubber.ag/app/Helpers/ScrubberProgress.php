<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 4/12/2016
 * Time: 2:03 PM
 */

namespace App\Helpers;


class ScrubberProgress {

    public $scrubber = array();
    public $scrubberType = array();
    public $scrubberDirection = array();

    public function getScrubber() {
        if (count($this->scrubber) == 0) return null;
        return $this->scrubber[count($this->scrubber)-1];
    }

    public function getScrubberType() {
        if (count($this->scrubberType) == 0) return null;
        return $this->scrubberType[count($this->scrubberType)-1];
    }

    public function getScrubberDirection() {
        if (empty($this->scrubberDirection)) return app()['objInit']->direction;
        return $this->scrubberDirection[count($this->scrubberDirection)-1];
    }
}