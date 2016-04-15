<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 4/12/2016
 * Time: 2:47 AM
 */

namespace App\Library;

use App\Library;
use Illuminate\Http\Request;

class ScrubberRequestLib {
    public $params = array();

    public function __construct(Request $request) {
        foreach($request->all() as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    public function ToString() {
        return http_build_query($this->params);
    }


}