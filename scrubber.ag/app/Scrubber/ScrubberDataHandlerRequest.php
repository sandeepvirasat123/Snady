<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 3/27/2016
 * Time: 9:40 AM
 */

namespace App\Scrubber;

use App\Library\ScrubberValidator;
use Illuminate\Http\Request;

class ScrubberDataHandlerRequest {

    /*
     * All field names are handled as "system" (or "sys") field names (see "sys" attribute in conf_fields.xml or field_to_db_mapper
     */
    private $objFields = null;
    private $arrInput = null;
    private $arrRequest = null;

    private $errors = array();
    private $warnings = array();

    public $objFieldToDb = null;
    public $objResult;

    public function __construct() {
        $this->objFields = new ScrubberField();

        foreach (app()['objRequest']->all() as $key => $value) {
            if ($this->objFields->exists($key)) {
                $arrInput[$key] = $value;

                $format = $this->objFields->getSysAttribute($key, "format");
                $validator = $this->objFields->getSysAttribute($key, "validator");
                $validated = true;
                $formatted = true;
                $required = $this->objFields->getSysAttribute($key, "required") == "true";

                //1. validate
                if (!empty($validator)) {
                    $fnc = $validator["fnc"];
                    $validated = ScrubberValidator::$fnc($value, $validator["exp"]);
                }

                //2. format
                if (!empty($format)) {
                    $fnc = $format["fnc"];
                    $formatted = ScrubberValidator::$fnc($value, $validator["exp"]);
                }

                echo ($validated."<br />");
                //3. Check for errors and warnings
                if (!$formatted || !$validated) {
                    $value = null;
                    if ($required) {
                        $this->errors[] = "Wrong input parameter: $key";
                    } else {
                        $this->warnings[] = "Wrong input parameter: $key";
                    }
                } else {
                    $this->arrRequest[$this->objFields->getSys2Variable($key)] = $value;
                }

            }
        }

        //4. Check that required that is available
        $req = $this->objFields->getVariableRequired();

        foreach ($req as $item) {
            if (!array_key_exists($item, $this->arrRequest)) {
                $this->errors[] = "Missing required parameter: $item";
            }
        }


        //1. Load data from the given config xml file for the given Scrubber and action (plugins\[$scrubber]\conf_fields_[type]_[action]_[direction].xml) into $objFields
        //2. Load all scrubber base configuration and supported types for this Scrubber (plugins\[$scrubber]\conf_base.xml)
        //3. Call >> setData($data);
    }

    public function hasErrors() {
        return count($this->errors) > 0;
    }

    public function hasWarnings() {
        return count($this->warnings) > 0;
    }

    public function getRequest() {
        return http_build_query($this->arrRequest);
    }


















    public function setData($data) {
        //receives posted data (POST call) >>> all keys correspond to the "sys" attribute in fields, no need to convert here
        //--load fields_to_db_mapper.xml into $objFieldToDb object
        //--traverses all data
        foreach ($data as $key => $value) {
            //to format ("format" attribute in $objFields) and validate ("validator" attribute in $objFields)
            //  optional fields with data that fail to format or validate are set as blank and a message is added to "$objResult->$warnings" ($empty values are ignored)
            //  required fields with data that fail to format or validate are set as blank and a message is added to "$objResult->$errors" ($empty values are ignored)

            //>> the fields that pass the checks do the following:
            $variable = $this->objFields->getScrubberVariableName($key);
            $variableDb = $this->objFieldToDb->getDbVariableName($key);
            $objField = new ScrubberField($key, $variable, $variableDb, $value);
            $this->objResult->arrData[$key] = $objField;
            $this->objResult->arrMiscVariables[$variable] = $key;
            $this->objResult->arrMiscVariablesDb[$variableDb] = $key;
            //The idea is to have a quick translation of the fields in order to put together Requests for example, doing something like this: $this->arrData[$this->objResult->arrMiscVariables[$variable]]
            //this is done as well in: getData() below
        }

        //--if $objResult->hasErrors() THEN return false ELSE continue

        //--Traverse through all required fields that have not been set yet (use objResult->arrData and $objFields)
        //  if missing data is required and "db" is not included in the "from" attribute of $objFields, THEN: add error to "$objResult->$errors"

        //--if $objResult->hasErrors() THEN return false ELSE continue

        //--if data is missing and "db" IS set in "from" attribute then:
        //--Traverse through all required fields that have not been set yet (use objResult->arrData and $objFields)
        //   ...call getData($Username, $UserID, $source, $sys, $variable)
        return true;
    }

    public function addData($key, $value) {
        $fields[$key] = $value;
    }

    public function getData($Username, $UserID, $source, $sysName, $variableName) {
        $token = ""; //this value must be set from the value passed in the {id} as follows: Route::post('scrubb/{id}', 'ScrubberController@Index');
        $ws = ""; //$ws is set from the "url" attribute in the "map" object @ "field_to_db_mapper.xml" file
        $url = "$ws/$token/$source?username=$Username&userid=$UserID";
        $arrKeys = array();
        $value = ""; //this is set Before point 3.1 below
        //$sysName is the name of the field in our system
        //$variableName is the name of the field as returned by the webservice

        //1. Check if the $source has been called (according to the "$arrCalledSources" object)
        //2. if not called, then:
        //   2.1. Call the action and parse results
        //   2.3. parse the returned info and Set key/value pairs of $objResult->arrDataDb (the key is the variable name (as returned by the webservice, not the sys name)
        //3. if variable name exists in $objResult->arrDataDb and it's counterpart $sys name is empty or non-existent in $objResult->arrData then
        //   3.1. add the key/value pair
        $variable = $this->objFields->getScrubberVariableName($sysName);
        $variableDb = $this->objFieldToDb->getDbVariableName($sysName);
        $objField = new ScrubberField($sysName, $variable, $variableDb, $value);
        $this->objResult->arrData[$sysName] = $objField;
        $this->objResult->arrMiscVariables[$variable] = $sysName;
        $this->objResult->arrMiscVariablesDb[$variableDb] = $sysName;

        //   3.1. if optional field fails to format or validate then blank value is set and message is added to "$objResult->$warnings" (check that the message is not already included)
        //   3.2. if required field fails to format or validate then blank value is set and message is added to "$objResult->$errors"
    }
} 