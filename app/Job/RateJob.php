<?php

namespace App\Job;

use App\Services\City\CityService;
use Illuminate\Support\Facades\Session;

class RateJob
{
    private $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }


    public function selectedCity($city_id = false)
    {
        if($city_id && $city = $this->cityService->getFind($city_id)){
            Session::put('citySelected',$city->id);
            return $city->id;
        }

        if(Session::has('citySelected')){
            return Session::get('citySelected');
        }

        if($city = $this->cityService->getClientFirst()){
            Session::put('citySelected',$city->id);
            return $city->id;
        }

        return false;
    }
}
