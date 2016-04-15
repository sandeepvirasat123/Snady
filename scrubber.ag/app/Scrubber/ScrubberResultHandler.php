<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 3/27/2016
 * Time: 12:08 PM
 */

namespace App\Scrubber;

class ScrubberResultHandler  {
    public $type = null;
    public $action = null;
    public $description = null;
    public $request = null;
    public $response = null;
    public $warnings = array();
    public $errors = array();

    public $arrData = array(); //holds associative key/object pairs of system ("sys") fields and values
    public $arrMiscVariables = array();
    public $arrMiscVariablesDb = array();

    public $arrDataRes = array(); //holds associative key/object pairs of system ("sys") fields and values
    public $arrMiscVariablesRes = array();
    public $arrMiscVariablesDbRes = array();

    public function hasErrors() {
        return count($this->errors) > 0;
    }
    public function hasWarnings() {
        return count($this->warnings) > 0;
    }
}