<?php

namespace App\Job;

use App\Models\Order;
use App\Models\Rate;
use App\Services\Address\AddressService;
use App\Services\City\CityService;
use App\Services\Rate\RateService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class RateJob
{
    private $cityService;
    private $domain;
    private $rateService;

    public function __construct(CityService $cityService, RateService $rateService)
    {
        $this->cityService = $cityService;
        $this->domain = request()->getHost();
        $this->rateService = $rateService;
    }


    public function selectedCity()
    {
        return $this->cityService->getDomainFind($this->domain);
    }


    public function saveRateAfterOrder($rate_id)
    {
        $city = $this->selectedCity();
        $rates = $city->rates;

        $userToken = Auth::check() ? Auth::id() : csrf_token();
        $nameCache = "rate_sale_{$city->id}_{$userToken}_{$rate_id}";

        $rate = $this->rateService->getFind($rate_id);

        if(Cookie::has($nameCache) === null){
            Cookie::make($nameCache,$rate,60);
        }
    }

    public function getRatesByCity()
    {
        $city = $this->selectedCity();

        $userToken = Auth::check() ? Auth::id() : csrf_token();

        return $city->rates->map(function($item) use ($city,$userToken){
            $nameCache = "rate_sale_{$city->id}_{$userToken}_{$item->id}";

            if(Cookie::has($nameCache)) {
                return Cookie::get($nameCache);
            }else{
                return $item;
            }
        });

    }
}
