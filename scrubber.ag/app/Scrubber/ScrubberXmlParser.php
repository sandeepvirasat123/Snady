<?php 
namespace Laravie\Parser\Xml\TestCase;
namespace App\Scrubber;

use Laravie\Parser\Xml\Reader;
use Laravie\Parser\Xml\Document;


class ScrubberXmlParser extends \PHPUnit_Framework_TestCase {
	
	public function __construct() {
		
	}
	/*
	 * Config_fields xml Load
	 */
    public function Xmlconfigfields($xmlfile)
    {
        $document = new Document();
        $stub     = new Reader($document);
        $output   = $stub->load($xmlfile);
		
		$data = $output->parse([
               'config_fields' => ['uses' => 'fields.field[::name>name,::variable>variable,::sys>sys,::validator>validator,::type>type,::required>required]', 'default' => null],   
          
        ]);
		return $data;
		
    }
	/*
	 * Config xml Load
	 */
	public function XmlLoadConfig($xmlfile)
    {
        $document = new Document();
        $stub     = new Reader($document);
        $output   = $stub->load($xmlfile);
		
		return $output;
	}
	/*
	 * Config xml get All data
	 */
	public function XmlConfigparse($xmlconfig)
    {
		$data = $xmlconfig->parse([
               'config' => ['uses' => 'action[::action>action,urls.setting(::setting=::value)>setting,credentials.setting(::setting=::value)>credentials,scrubbTypes.setting(::setting=::value)>scrubbTypes,]', 'default' => null],   
          
        ]);
			
		//return $data;
		
    }
	/*
	 * Config xml get Setting
	 */
	public function XmlConfigSettingparse($xmlconfig)
    {
		$data = $xmlconfig->parse([
               'Settings' => ['uses' => 'action[::action>action,urls.setting(::setting=::value)>setting]', 'default' => null],   
          
        ]);
			
		return $data;
		
    }
	/*
	 * Config xml get Credentials
	 */
	public function XmlConfigCredentialsparse($xmlconfig)
    {
		$data = $xmlconfig->parse([
               'credentials' => ['uses' => 'action[::action>action,credentials.setting(::setting=::value)>credentials]', 'default' => null],   
          
        ]);

        $result = array();
        if (!isset($data['credentials'][0]['credentials'])) return null;

        $data = $data['credentials'][0]['credentials'];

        foreach ($data as $credential => $value) {
            $result[$credential] = $value;
        }
			
		return $data;
    }

    public function XmlConfigUrlsParse($xmlconfig)
    {
        $data = $xmlconfig->parse([
            'urls' => ['uses' => 'action[::action>action,urls.setting(::setting=::value)>urls]', 'default' => null],

        ]);

        $result = array();
        if (!isset($data['urls'][0]['urls'])) return null;

        $data = $data['urls'][0]['urls'];

        foreach ($data as $url => $value) {
            $result[$url] = $value;
        }

        return $data;
    }

    /*
	 * Config xml get Decisions
	 */
    public function XmlConfigDecisions($xmlconfig)
    {
        $data = $xmlconfig->parse([
            'decisions' => ['uses' => 'decisions[::for>token,decision(::score=::convert)>scores]', 'default' => null],
        ]);
        return $data;
    }


	/*
	 * Config xml get scrubbertype
	 */
	public function XmlConfigscrubbTypesparse($xmlconfig)
    {
		$data = $xmlconfig->parse([
               'scrubbTypes' => ['uses' => 'action[::action>action,scrubbTypes.setting(::setting=::value)>scrubbTypes]', 'default' => null],
        ]);
		return $data;
    }



    /*
    * Config xml get supported scrubbertype array
     * returns simple array with value="true"
     * of scrubberTypes.
     * example:
     * array(
     * 0 => "device",
     * 1 => "check"
     * )
    */
    public function XmlConfigScrubbTypesSupportedParse($xmlconfig)
    {
        $data = $this->XmlConfigscrubbTypesparse($xmlconfig);
        $result = array();
        if (!isset($data['scrubbTypes'][0]['scrubbTypes'])) return null;

        $data = $data['scrubbTypes'][0]['scrubbTypes'];

        foreach ($data as $type => $supported) {
            if ($supported == "true" ) $result[] = $type;
        }
        return $result;
    }
   
}