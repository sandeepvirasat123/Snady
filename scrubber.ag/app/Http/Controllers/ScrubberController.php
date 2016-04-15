<?php

namespace App\Http\Controllers;

use App\Events\ScrubberJournalNew;
use App\Library\ScrubberFormat;
use App\Library\ScrubberValidator;
use Event;
use App\Events\ScrubberRequest;
use App\Helpers\ScrubberScrubbers;
use App\Helpers\ScrubberProgress;;
use App\Library\ScrubberTokenLib;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use App\Listeners;
use Illuminate\Http\Request;

use App\Scrubber;

use App\Scrubber\BaseScrubber;

use App\Helpers\ScrubberInit;

class ScrubberController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $arrScrubberObjs = array();
    public $objInit;

    public function __construct(ScrubberInit $objInit, ScrubberScrubbers $objScrubbers) {

        //$this->objInit = $objInit;
        //$objInit->action = "new";
        //App::Bind('ScrubberInit', $objInit);

        //1. Initialize the main settings object:
        //app()->instance('objInit', $objInit);
        //2. Set the available scrubber plugins
        app()->instance('objScrubbers', $objScrubbers);
    }

    public function init() {
        //return $this->respository->test();
    }

    public function Start() {
        //dd($this->respository);
    }

    /*
     * Saves a Header record
     */


    public function Index(ScrubberTokenLib $objTokenLib, ScrubberProgress $scrubberProgress, Request $request) {
        //app()->instance('objTokenLib', $objTokenLib);

        //dd($objTokenLib);
        //dd(app()['objTokenLib']);

        //$token = ScrubberToken::ofToken()->get();
        //return $token[0];

        //dd(app()['objScrubbers']);
        //dd(app()['objInit']);

        app()->instance('objProgress', $scrubberProgress);

        app()->instance('objRequest', $request);

        //...filtering the scrubbers available.
        app()['objInit']->scrubberFilter();


        //$i = 0;
        foreach (app()['objInit']->scrubbers as $scrubber) {
            app()['objProgress']->scrubber[] = $scrubber;

            $model = "\\App\\Scrubber\\".$scrubber."\\".$scrubber."Scrubber";
            $objScrubber = new $model;

            Event::fire(new ScrubberJournalNew());

            foreach ($objScrubber->scrubberTypes as $scrubberType) {
                app()['objProgress']->scrubberType[] = $scrubberType;
                //$i++;
                //if ($i == 3) {
                //    Event::fire(new ScrubberRequest($i));
                //}
            }
        }


dd(app()['objProgress']);



        $temp = new \App\Scrubber\ScrubberConfDecision();
        dd($temp->makeDecision(2.5));

        //dd(app()['objInit']);

        $temp = new \App\Scrubber\ScrubberConfBase();
        dd($temp->getSupportedScrubbTypes());




        $res = \GuzzleHttp\json_encode( app()['objInit'] );
        //$res = \GuzzleHttp\json_encode( $objScrubbers, true );
        return $res;


        $test = new \App\Helpers\ScrubberScrubbers();
        dd($test->test());

        dd(app()['objInit']);
        $app = app();
        $test = $app['App\Helpers\ScrubberInit'];
        dd($test);
        $content = '{"result":"success","id":"'.$id.'"}';

        //$test->token= "a";
        //return $test;

        if (Validator::ip("192.168.71.25")) {
            return "true";
        } else {
            return "false";
        }

        return $content;

        $data = array();
        $arrScrubbers = array();
        $arrTypes = array();
        $strAction = "new";
        $strDirection = "request";

        //$response = Event::fire(new ScrubberRequest());

        //***********************************
        //1. $arrScrubbers: Check if scrubbers have been specified and set here
        //2. if not: set the $arrScrubbers array with the directories read at Scrubber/plugins (all possible scrubbers)
        //3. verify in Database if the scrubbers exist and are enabled for the given $id.
        //4. an array with the valid scrubbers is generated (i.e.: $arrScrubbers[0] = "AcuityTec", $arrScrubbers[1] = "Iovation")
        //5. $arrTypes: set the scrubber types that the user wants to run
        //6. $strAction: most of the time this will be "new" for a brand new run
        //6. $strDirection: most of the time this will be "request", usually, "response" actions are only initiated by the processor (example: asynchronous notification)
        //7. set $data with all the incoming information

        //6. traverse through all available scrubbers and populate the $arrScrubberObjs array:
        for ($i = 0; $i < count($arrScrubbers); $i++) {
            //instantiate the given scrubber objects: Scrubber\plugins\[Scrubber name]\[Scrubber name]Scrubber
            //for example:  Scrubber\plugins\AcuityTec\AcuityTecScrubber, Scrubber\plugins\Iovation\IovationScrubber
            $arrScrubberObjs[$arrScrubbers[$i]] = new $arrScrubbers[$i]."Scrubber";

        }

        /**
         * @var BaseScrubber $objScrubber
         */
        //initialize each scrubber
        foreach ($arrScrubbers as $k => $objScrubber) {
            $objScrubber->arrType = $arrTypes;
            $objScrubber->strAction = $strAction;
            $objScrubber->setNewInstance();

            for ($i = 0; $i < count($objScrubber->arrType); $i++) {
                //Prepare Data
                $objScrubber->loadScrubberDataHandlerRequest($data, $objScrubber->arrType[$i]);
                //make the request to the scrubber webservice
                $objScrubber->request();
                //Parse the response
                $objScrubber->response();
                //Finally translate the results according to our settings
                $objScrubber->translateResponseData();
            }
        }

    }

    /*
     * http://scrubber.ag/scrubber/scrubbers
     */
    public function getScrubbers() {
        return array(
            array ("id" => 1, "name" => "acuitytec", "type" => "person"),
            array ("id" => 2, "name" => "iovation", "type" => "device"),
            array ("id" => 3, "name" => "maxmind", "type" => "person"),
            array ("id" => 4, "name" => "ccscrubber", "type" => "creditcard")
        );
    }

    public function getScrubb() {
        return "test";
    }

    public function postScrubb() {
        return Input::get('Email');
    }

    public function xml()
    {
        $scrubber = new BaseScrubber();

        return $scrubber->loadConfBase();
    }

}