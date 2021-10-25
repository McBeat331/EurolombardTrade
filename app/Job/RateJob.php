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
    private $rateService;
    private $addressService;

    public function __construct(
        RateService $rateService,
        AddressService $addressService
    )
    {
        $this->rateService = $rateService;
        $this->addressService = $addressService;
    }


    public function selectedAddress($address_id = false)
    {
        if($address_id && $address = $this->addressService->getFind($address_id)){
            Session::put('addressSelected',$address);
            return $address;
        }

        if(Session::has('addressSelected')){
            return Session::get('addressSelected');
        }

        if($address = $this->addressService->getClientFirst()){
            Session::put('addressSelected',$address);
            return $address;
        }

        abort(500, 'Database `Addresses` is not filled');
    }


    public function saveRateAfterOrder()
    {
        $address = $this->selectedAddress();
        $cityId = $address->city_id;
        $rates = $this->rateService->getRatesByCity($cityId);

        $userToken = Auth::check() ? Auth::user()->id : csrf_token();
        $nameCache = "rate_sale_{$cityId}_{$userToken}";

        if(Cache::has($nameCache) === null){
            Cache::put($nameCache,(object)[
                'city_id' => $cityId,
                'rates' => $rates
            ],3600);
        }
    }

    public function getRatesByCity()
    {
        $address = $this->selectedAddress();
        $cityId = $address->city_id;

        $userToken = Auth::check() ? Auth::user()->id : csrf_token();
        $nameCache = "rate_sale_{$cityId}_{$userToken}";

        if(Cache::has($nameCache) === null) {
            return $this->rateService->getRatesByCity($address->city_id);
        }else{
            return Cache::get($nameCache);
        }

    }
}
