<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 3/27/2016
 * Time: 5:23 PM
 */

namespace App\Scrubber;
use Illuminate\Database\Eloquent\Model;

class ScrubberConfBase extends Model{

    public function __construct() {
        //reads and loads "conf_base.xml" for given scrubber ($modelName)
        //$app_path = app_path();
        $this->cofigfile = \App\Library\ScrubberPaths::getConfBase();
        $this->XmlParser = new ScrubberXmlParser;
        $this->settings = $this->XmlParser->XmlLoadConfig($this->cofigfile);
    }

    /*
     * get settings fields values of config xml
     */
    public function getSettingsValue(){
        return $data =  $this->XmlParser->XmlConfigSettingparse($this->settings);
    }
    /*
     * get ScrubTypes values of config xml
     */
    public function getScrubTypes(){
        return $data = 	$this->XmlParser->XmlConfigscrubbTypesparse($this->settings);
    }
    /*
     * get Credencials values of config xml
     */
    public function getCredencials(){
        return $data = $this->XmlParser->XmlConfigCredentialsparse($this->settings);
    }

    public function getUrls(){
        return $data = $this->XmlParser->XmlConfigUrlsParse($this->settings);
    }

    /*
     * get supported ScrubbTypes
     */
    public function getSupportedScrubbTypes(){
        return $data = $this->XmlParser->XmlConfigScrubbTypesSupportedParse($this->settings);
    }


} 