<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 3/27/2016
 * Time: 5:23 PM
 */

namespace App\Scrubber;

use App\Library;

class ScrubberConfDecision{
    public $obj = array();

    public function __construct() {
        $xml = simplexml_load_file(\App\Library\ScrubberPaths::getConfDecision());

        foreach($xml->children() as $decisions)
        {
            if (isset($decisions["for"])) {
                $this->obj[(string)$decisions["for"]] = array();

                $arrayDecision = array();
                foreach($decisions->children() as $decision) {
                    $temp = array(
                        "score" => Library\ScrubberUtils::filterValue($decision["score"]),
                        "convert" => Library\ScrubberUtils::filterValue($decision["convert"]),
                        "scrubbTypes" => Library\ScrubberUtils::filterValue($decision["scrubbTypes"]),
                        "type" => Library\ScrubberUtils::filterValue($decision["type"]),
                    );

                    if ($temp["type"] == "range") {
                        $temp["score"] = explode("|", $temp["score"]);
                    }

                    $arrayDecision[] = $temp;
                }

                $this->obj[(string)$decisions["for"]] = $arrayDecision;
            }
        }
    }

    public function getDecisions() {
        if (isset($this->obj[app()['objInit']->token])) return $this->obj[app()['objInit']->token];
        if (isset($this->obj["default"])) return $this->obj["default"];
        return null;
    }

    public function makeDecision($score) {
        $decisions = $this->getDecisions();
        foreach ($decisions as $decision) {
            if ($score > $decision["score"][0] && $score <= $decision["score"][1]) {
                return $decision["convert"];
            }
        }
        return null;
    }
} 