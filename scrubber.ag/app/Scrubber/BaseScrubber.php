<?php

namespace App\Scrubber;

use Illuminate\Http\Request;

class BaseScrubber {
    protected $modelName;
    protected $instance;
    protected $response;

    protected $urls;
    protected $credentials;

    public $scrubberTypes;

    public $arrType;
    public $strAction;
    //public $objConfBase;
    public $objDataHandlerRequest;
    public $objDataHandlerResponse;
    private $xml_conf_errors;

    public $filtered = false;

    public function __construct() {
        if (!isset($this->instance)) {
            $this->setNewInstance();
        }

        if (app()["objProgress"]->getScrubberDirection() == 'request') {
            $this->objDataHandlerRequest = new ScrubberDataHandlerRequest(new Request() );
        }

    }

    public function setNewInstance() {
        $model = $this->modelName;
        $this->instance = new $model;

        $temp = new ScrubberConfBase();
        $this->scrubberTypes = $temp->getSupportedscrubbTypes();
        $this->credentials = $temp->getCredencials();
        $this->urls = $temp->getUrls();



        $this->verifyTypes();
    }

    public function getInstance() {
        return $this->instance;
    }

    public function verifyTypes() {

        if (!empty($this->scrubberTypes)) {
            $top = count($this->scrubberTypes);
            $done = false;
            for ($i = 0; $i < $top; $i++) {
                if ($top > $i && !in_array($this->scrubberTypes[$i], app()['objInit']->scrubberTypes)) {
                    unset($this->scrubberTypes[$i]);
                } else {
                    if (!$done) {
                        app()['objProgress']->scrubberType[] = $this->scrubberTypes[$i];
                    }
                }
            }
            $this->filtered = true;
        }
    }



    public function loadConfDecision(){

    }

    public function loadConfErrors(){

    }

    public function loadScrubberDataHandler($data, $type){
        //Loads the ScrubberDataHandlerRequest which takes care of all the required parameters
        $this->objDataHandler = new ScrubberDataHandlerRequest($data, $this->modelName, $type, $this->strAction);
    }

    public function request() {
       //$this->getInstance()->request($this->objDataHandler->objResultHandler);
    }

    public function response() {
        //$this->getInstance()->response($this->objDataHandler->objResultHandler);
        $this->loadScrubberDataHandlerResponse($this->objDataHandlerRequest->objResultHandler->arrDataRes, $this->objDataHandlerRequest->objResultHandler->type);
    }


    public function loadScrubberDataHandlerResponse($data, $type){
        //Loads the ScrubberDataHandlerResponse which takes care of all the response parameters
        $this->objDataHandlerResponse = new ScrubberDataHandlerResponse($data, $this->modelName, $type, $this->strAction, $this->objDataHandlerRequest->objFieldToDb);
    }

    public function translateResponseData() {
        //
    }

    public function loadConfReasons(){

    }

    public function loadConfScore(){

    }

    public function loadConfStatus(){

    }

    public function loadConfSuggest(){

    }

}