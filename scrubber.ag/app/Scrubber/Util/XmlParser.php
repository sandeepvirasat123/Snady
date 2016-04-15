<?php
namespace App\Scrubber\Util;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class XmlParser
{
    function __construct()
    {
    }

    public static function load($path)
    {
        $xml = NULL;
        try
        {
            $file = file_get_contents(__DIR__.'/'.$path);
            $xml = json_encode(self::xmlParse($file));
        }
        catch(\Exception $error)
        {
            Log::error( 'Line 14, Date: ' . Carbon::now() . ' Error: z' .$error);
        }

        return self::convertToJson($xml);
    }

    public static function convertToJson($xml)
    {
        return json_decode($xml);
    }

    /**
     * @param $file
     * @return \SimpleXMLElement
     */
    private static function xmlParse($file)
    {
        $xml = simplexml_load_string($file);

        return $xml;
    }

}