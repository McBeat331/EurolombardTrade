<?php

namespace App\Job;

use App\Services\Address\AddressService;
use App\Services\City\CityService;
use App\Services\Rate\RateService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class RateJob
{
    private $cityService;
    private $domain;

    public function __construct(
        CityService $cityService
    )
    {
        $this->cityService = $cityService;
        $this->domain = request()->getHost();
    }


    public function selectedCity()
    {
        return $this->cityService->getDomainFind($this->domain);
    }


    public function saveRateAfterOrder()
    {
        $city = $this->selectedCity();
        $rates = $city->rates;

        $userToken = Auth::check() ? Auth::id() : csrf_token();
        $nameCache = "rate_sale_{$city->id}_{$userToken}";

        if(Cache::has($nameCache) === null){
            Cache::put($nameCache,(object)[
                'city_id' => $city->id,
                'rates' => $rates
            ],3600);
        }
    }

    public function getRatesByCity()
    {
        $city = $this->selectedCity();

        $userToken = Auth::check() ? Auth::id() : csrf_token();
        $nameCache = "rate_sale_{$city->id}_{$userToken}";

        if(!Cache::has($nameCache)) {
            return $city->rates;
        }else{
            return Cache::get($nameCache);
        }

    }
}
