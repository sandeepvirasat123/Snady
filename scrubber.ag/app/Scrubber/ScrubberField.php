<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 3/27/2016
 * Time: 5:23 PM
 */

namespace App\Scrubber;

class ScrubberField{
    public $obj = array();
    public $sys = array();
    public $variable = array();


    public function __construct() {
        $xml = simplexml_load_file(\App\Library\ScrubberPaths::getFields());

        $i = 0;
        foreach($xml->fields->children() as $field)
        {
            $arrayItem = array(
                'name' =>  ( isset($field["name"]) ? (string)$field["name"] : null ),
                'variable' => ( isset($field["variable"]) ? (string)$field["variable"] : null ),
                'sys' => ( isset($field["sys"]) ? (string)$field["sys"] : null ),
                'required' => ( isset($field["required"]) ? (string)$field["required"] : null ),
                'type' => ( isset($field["type"]) ? (string)$field["type"] : null ),
                'validator' => ( isset($field["validator"]) ? (string)$field["validator"] : null ),
                'length' => ( isset($field["length"]) ? (string)$field["length"] : null ),
                'format' => ( isset($field["format"]) ? (string)$field["format"] : null )
            );

            if (isset($arrayItem['validator'])) {
                $temp = explode("@", $arrayItem['validator']);
                $arrayItem['validator'] = array(
                    "fnc" => $temp[0],
                    "exp" => ( isset($temp[1]) ? $temp[1] : null )
                );
            }

            if (isset($arrayItem['format'])) {
                $temp = explode("@", $arrayItem['format']);
                $arrayItem['format'] = array(
                    "fnc" => $temp[0],
                    "exp" => ( isset($temp[1]) ? $temp[1] : null )
                );
            }

            if (isset($field["sys"]) && isset($field["variable"])) {
                $this->obj[] = $arrayItem;
                $this->sys[(string)$field["sys"]] = $i;
                $this->variable[(string)$field["variable"]] = $i;
                $i++;
            }
        }
    }

    public function getSys($sys) {
        return $this->obj[$this->sys[$sys]];
    }

    public function getSysRequired() {
        $req = array();
        foreach ($this->obj as $item) {
            if ($item["required"] == true) {
                $req[] = $item["sys"];
            }
        }
        return $req;
    }

    public function getVariableRequired() {
        $req = array();
        foreach ($this->obj as $item) {
            if ($item["required"] == "true") {
                $req[] = $item["variable"];
            }
        }
        return $req;
    }

    public function getVariable($variable) {
        return $this->obj[$this->variable[$variable]];
    }

    public function getVariableAttribute($variable, $attribute) {
        $item = $this->getVariable($variable);
        return $item[$attribute];
    }

    public function getSysAttribute($sys, $attribute) {
        $item = $this->getSys($sys);
        return $item[$attribute];
    }

    public function getSys2Variable($sys) {
        $item = $this->getSys($sys);
        return $item["variable"];
    }

    public function getVariable2Sys($variable) {
        $item = $this->getVariable($variable);
        return $item["sys"];
    }

    public function exists($sys) {
        return array_key_exists($sys, $this->sys);
    }

} 