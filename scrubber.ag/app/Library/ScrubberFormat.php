<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 4/6/2016
 * Time: 8:40 PM
 */

namespace App\Library;


class ScrubberFormat {

    public static function checkDateTime($str_dt, $str_dateformat) {
        $date = date_create_from_format($str_dateformat, $str_dt);
        return $date && date_get_last_errors()["warning_count"] == 0 && date_get_last_errors()["error_count"] == 0;
    }

    public static function date($date, $format) {
        if (self::checkDateTime($date, $format) == false) return null;
        $date = date_create($date);
        return date_format($date, $format);
    }

}