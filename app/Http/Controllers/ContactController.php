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


//        $phone = $this->settingService->getField('phone'); // or null
        dd(
            $settings
        );
//        return view('');
    }
}
