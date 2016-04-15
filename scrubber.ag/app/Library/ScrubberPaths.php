<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 4/12/2016
 * Time: 3:08 PM
 */

namespace App\Library;

class ScrubberPaths {

    public static function getConfBase() {
        return app()['objScrubbers']->pathPlugin."\\".app()['objProgress']->getScrubber()."\\conf_base.xml";
    }

    public static function getConfDecision() {
        return app()['objScrubbers']->pathPlugin."\\".app()['objProgress']->getScrubber()."\\conf_decision.xml";
    }

    public static function getConfErrors() {
        return app()['objScrubbers']->pathPlugin."\\".app()['objProgress']->getScrubber()."\\conf_errors.xml";
    }

    public static function getConfReasons() {
        return app()['objScrubbers']->pathPlugin."\\".app()['objProgress']->getScrubber()."\\conf_reasons.xml";
    }

    public static function getConfScore() {
        return app()['objScrubbers']->pathPlugin."\\".app()['objProgress']->getScrubber()."\\conf_score.xml";
    }

    public static function getConfStatus() {
        return app()['objScrubbers']->pathPlugin."\\".app()['objProgress']->getScrubber()."\\conf_status.xml";
    }

    public static function getConfSuggest() {
        return app()['objScrubbers']->pathPlugin."\\".app()['objProgress']->getScrubber()."\\conf_suggest.xml";
    }

    public static function getField2Db() {
        return app()['objScrubbers']->pathBase."\\Scrubber\\field_to_db_mapper.xml";
    }

    public static function getFields() {
        return app()['objScrubbers']->pathPlugin."\\".app()['objProgress']->getScrubber()."\\conf_fields_".app()['objProgress']->getScrubberType()."_".app()['objInit']->action."_".app()['objProgress']->getScrubberDirection().".xml";
    }

}