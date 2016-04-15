<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 3/27/2016
 * Time: 5:25 PM
 */

namespace App\Scrubber;

class ScrubberConfErrors {
    private $xml_conf_errors;

    public function __construct($modelName) {
        //reads and loads "conf_errors.xml" for given scrubber ($modelName)
        $xml = Parser::load('../plugins/AcuityTec/conf_base.xml');
        $this->xml_conf_errors = Parser::convertToJson($xml);
    }

} 