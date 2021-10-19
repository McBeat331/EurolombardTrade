<?php

namespace App\Http\Controllers;


use App\Services\Setting\SettingService;

class ContactController extends Controller
{

    public $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function show()
    {
        $settings = $this->settingService->getAll();
//        $phone = $this->settingService->getField('phone'); // or null
        dd($settings);
//        return view('');
    }
}
