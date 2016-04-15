<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 4/8/2016
 * Time: 6:07 AM
 */

namespace App\Helpers;


class ScrubberScrubbers {
    public $pathBase;
    public $pathPlugin;
    public $scrubberPlugins;

    public function __construct() {
        $this->pathBase = app_path();
        $this->pathPlugin .= "$this->pathBase\\Scrubber\\plugins";
        $this->scrubberPlugins = array_filter(glob($this->pathPlugin."\\*"), 'is_dir');

        foreach ($this->scrubberPlugins as &$str) {
            $str = str_replace($this->pathPlugin."\\", '', $str);
        }
    }

} 