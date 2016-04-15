<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 4/12/2016
 * Time: 2:47 AM
 */

namespace App\Library;

use App\Models\ScrubberToken;
use Illuminate\Http\Request;

class ScrubberTokenLib {
    public $id;
    public $token;
    public $description;
    public $active;
    public $enabled;

    public function __construct(Request $request) {
        $token = ScrubberToken::ofToken()->get();

        if ($token && count($token) == 1) {
            $token = $token[0];
            $this->id = $token->id;
            $this->token = $request->id;
            $this->description = $token->description;
            $this->active = $token->active;
            $this->enabled = $token->enabled;
        }
    }
}