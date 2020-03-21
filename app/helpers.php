<?php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

if (!function_exists('json2array')) {
    function json2array($json)
    {
        $jsonArray = json_decode($json);
        $list = [];
        if($jsonArray === null || gettype($jsonArray) != "object") {
            array_push($list, $json);
        }
        else{
            foreach ($jsonArray as $key => $value){
                array_push($list, $value);
            }
        }
        return $list;
    }
}
