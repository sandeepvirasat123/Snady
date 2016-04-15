<?php

namespace App\Helpers\Contracts;

interface ScrubberInterface {
    public function getModelName();
    public function translateStatus($objResultHandler);
    public function translateScore($objResultHandler);
    public function request($objResultHandler);
    public function response($objResultHandler);
}