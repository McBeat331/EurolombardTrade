<?php

namespace App\Http\Controllers;


use App\Job\RateJob;
use App\Services\Address\AddressService;
use App\Services\City\CityService;
use App\Services\Setting\SettingService;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    private $settingService;
    private $cityService;
    private $rateJob;
    private $addressService;
    public function __construct(
        SettingService $settingService,
        CityService $cityService,
        RateJob $rateJob,
        AddressService $addressService
    )
    {
        $this->settingService = $settingService;
        $this->cityService = $cityService;
        $this->rateJob = $rateJob;
        $this->addressService = $addressService;
    }

    public function show()
    {
        $settings = $this->settingService->getAll();
        $currentCity = $this->rateJob->selectedCity();

        return view('contacts.contact', compact('settings','currentCity'));
    }

//    public function getDepartments(Request $request)
//    {
//        if($request->get('city_id'))
//        {
//            $entries = $this->addressService->getAll();
//            return response()->json($entries, '200');
//        }
//        else{
//            $entries = $this->addressService->getAll();
//            return response()->json($entries, '200');
//        }
//    }
}
