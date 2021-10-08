<?php

use App\Services\Country\CountryService;


if(!function_exists('countries')){
    function countries(){
        return (new CountryService)->getAll(['addresses']);
    }
}