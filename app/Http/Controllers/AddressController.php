<?php

namespace App\Http\Controllers;

use App\Job\RateJob;
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
        $addressId = $request->get('address_id', false);

        $this->rateJob->selectedAddress($addressId);

        $rates = $this->rateJob->getRatesByCity();

        return response()->json([
            'success' => true,
            'data' => $rates
        ], 200);
    }
}
