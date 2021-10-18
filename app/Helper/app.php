<?php

use App\Services\City\CityService;


if(!function_exists('cities')){
    function countries(){
        return (new CityService)->getAll(['addresses']);
    }
}
