<?php

use App\Services\City\CityService;


if(!function_exists('cities')){
    function cities(){
        return (new CityService)->getAll(['addresses']);
    }
}
