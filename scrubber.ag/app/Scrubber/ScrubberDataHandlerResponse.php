<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 3/27/2016
 * Time: 9:40 AM
 */

namespace App\Scrubber;

class ScrubberDataHandlerResponse {

    /*
     * All field names are handled as "system" (or "sys") field names (see "sys" attribute in conf_fields.xml or field_to_db_mapper
     */

    private $scrubber = "";
    private $action = "";
    private $type = "";
    private $direction = "response";
    private $objFields = null;
    private $objFieldToDb = null;

    public $objResult;

    public function __construct($data, $scrubber, $type, $action, $objFieldToDb) {
        $this->scrubber = $scrubber; //$scrubber is the name of the scrubber (i.e.: "AcuityTec", or "Iovation")
        $this->type = $type;
        $this->action = $action;
        $this->objFieldToDb = $objFieldToDb;
        if (!isset($objFieldToDb)) {
            //--load fields_to_db_mapper.xml into $objFieldToDb object
        }

        //1. Load data from the given config xml file for the given Scrubber and action (plugins\[$scrubber]\conf_fields_[type]_[action]_[direction].xml) into $objFields
        //3. Call >> setData($data);
        setData($data);
    }

    public function setData($data) {
        //receives processor parsed data array (POST call)
        //--traverses all data
        foreach ($data as $key => $value) {
            $sys = $this->objFields->getScrubberSysName($key);
            $variableDb = $this->objFieldToDb->getDbVariableName($sys);
            $objField = new ScrubberField($sys, $key, $variableDb, $value);
            $this->objResult->arrDataRes[$sys] = $objField;
            $this->objResult->arrMiscVariablesRes[$key] = $sys;
            $this->objResult->arrMiscVariablesDbRes[$variableDb] = $sys;
            //The idea is to have a quick translation of the fields in order to put together Requests for example, doing something like this: $this->arrData[$this->objResult->arrMiscVariables[$key]]
        }

        //--perform any basic validations,
        //  minor issues will add a message to $objResult->warnings,
        //  in case there was something really wrong (for example: api server not responding) then
        //  add error message to $objResult->errors

        //--if $objResult->hasErrors() THEN return $objResult ELSE continue
    }


}