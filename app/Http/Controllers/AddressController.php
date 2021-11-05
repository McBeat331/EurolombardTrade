<?php

namespace App\Http\Controllers;

use App\Job\RateJob;
use App\Services\City\CityService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $rateJob;

    public function __construct(RateJob $rateJob)
    {
        $this->rateJob = $rateJob;
    }

    public function getRatesByCity(Request $request)
    {

        $rates = $this->rateJob->getRatesByCity();

        return response()->json([
            'success' => true,
            'data' => $rates->toArray()
        ], 200);
    }

    public function getCities(Request $request)
    {
        $entries = $this->rateJob->allCities();

        return response()->json([
            'success' => true,
            'data' => $entries
        ], 200);
    }

    public function getCityCurrent(Request $request){
        $entry = $this->rateJob->selectedCity();

        return response()->json([
            'success' => true,
            'data' => $entry
        ], 200);
    }
}
