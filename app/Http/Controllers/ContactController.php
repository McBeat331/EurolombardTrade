<?php

namespace App\Http\Controllers;


use App\Job\RateJob;
use App\Services\Setting\SettingService;

class ContactController extends Controller
{

    private $settingService;
    private $rateJob;

    public function __construct(
        SettingService $settingService,
        RateJob $rateJob
    )
    {
        $this->settingService = $settingService;
        $this->rateJob = $rateJob;
    }

    public function show()
    {
        $settings = $this->settingService->getAll();

        $currentCity = $this->rateJob->selectedCity();


//        $phone = $this->settingService->getField('phone'); // or null
        dd(
            $settings,
            $currentCity
        );
//        return view('');
    }
}
