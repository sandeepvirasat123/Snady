<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 3/20/2016
 * Time: 11:33 PM
 */

namespace App\Scrubber;

class CustomValidators {

    public static function validateIp($ip){
        return inet_pton($ip) !== false;
    }
} 