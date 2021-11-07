<?php

namespace App\Http\Controllers;

use App\Notifications\CallbackNotification;
use App\Services\Communication\CallbackServices;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CallbackRequest;
use App\Job\RateJob;
use App\Mail\CallbackMail;
use App\Services\Setting\SettingService;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    private $settingService;
    private $rateJob;
    private $callbackService;

    public function __construct(
        SettingService $settingService,
        RateJob $rateJob,
        CallbackServices $callbackService
    )
    {
        $this->settingService = $settingService;
        $this->rateJob = $rateJob;
        $this->callbackService = $callbackService;
    }

    public function show()
    {
        $settings = $this->settingService->getAll();
        $currentCity = $this->rateJob->selectedCity();

        return view('contacts.contact', compact('settings','currentCity'));
    }

    public function createCallback(Request $request)
    {
        $data = $this->rateJob->addCityToData($request->all());
        $entry = $this->callbackService->add($data);

        try {
            Mail::to($this->settingService->getFieldValue('callRequestEmail'))->send(new CallbackMail($entry));
            $entry->notify(new CallbackNotification());
        } catch (Exception $e) {
            Log::info($e);
        }

        return $entry;
    }
}
