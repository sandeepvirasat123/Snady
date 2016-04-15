<?php
namespace App\Scrubber\AcuityTec;

use App\Scrubber;
use App\Helpers\Contracts;

class AcuityTec implements Contracts\ScrubberInterface{
    private $objBase = null;

    public function __construct()
    {
        //Load the "conf_base.xml" for this scrubber into $objBase
    }

    public function test() {
        return " - loaded 'test' function from AcuityTec";
    }

    public function getModelName() {
        return $this->modelName;
    }

    public function translateStatus($objResultHandler) {
        return "approve";
    }

    public function translateScore($objResultHandler){
        return 10;
    }

    public function request($objResultHandler)
    {
        $request = null;
        //1. prepare request, set it to the $request variable
        $objResultHandler->request = $request;
        //2. make request and receive response
        //   call the scrubber webservice
        //3. set response
        switch ($this->strAction) {
            case "new":
                $objResultHandler->response = "result=true";
                return "response new";
                break;
            case "update":
                $objResultHandler->response = "result=true";
                return "response update";
                break;
        }
    }

    public function response($objResultHandler)
    {
        $data = null;
        //$objResultHandler must be passed by reference, or affected some other way
        //parse $response into $data (keys in this array correspond to the scrubber variable name)
        //data is read from $objResultHandler->response
        $objResultHandler->$arrDataRes = $data;
    }

}