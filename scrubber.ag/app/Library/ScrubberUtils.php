<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 4/13/2016
 * Time: 12:29 PM
 */

namespace App\Library;


class ScrubberUtils {

    public static function filterValue($value) {
        return (isset($value) ? (string) $value : null );
    }

} 