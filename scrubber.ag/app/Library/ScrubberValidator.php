<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 4/6/2016
 * Time: 8:40 PM
 */

namespace App\Library;


class ScrubberValidator {

    public static function ip($ip, $na = null) {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) || filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
    }

    public static function reg($str, $reg) {
        if (@preg_match($reg, $str) === false) return false;

        if (preg_match($reg, $str)) return true;

        return false;
    }
} 