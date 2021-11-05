<?php

namespace App\Http\Controllers;


use App\Http\Requests\FeedbackRequest;
use App\Job\RateJob;
use App\Mail\FeedbackMail;
use App\Models\Rate;
use App\Services\Advantage\AdvantageService;
use App\Services\Communication\FeedbackServices;
use App\Services\Service\ServiceService;
use App\Services\Setting\SettingService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ServiceController extends Controller
{
    private $serviceService;
    private $feedbackServices;
    private $settingService;
    private $rateJob;

    public function __construct(
        ServiceService $serviceService,
        FeedbackServices $feedbackServices,
        SettingService $settingService,
        RateJob $rateJob
    )
    {
        $this->serviceService = $serviceService;
        $this->feedbackServices = $feedbackServices;
        $this->settingService = $settingService;
        $this->rateJob = $rateJob;
    }

    public function index()
    {
        $entries = $this->serviceService->getPaginate();
        dd($entries);
    }

    public function show($slug)
    {
        $entry = $this->serviceService->getBySlug($slug);
        dd($entry);
    }

    public function createFeedback(FeedbackRequest $request)
    {
        $data = $this->rateJob->addCityToData($request->all());
        $entry = $this->feedbackServices->add($data);

        try {
            Mail::to($this->settingService->getFieldValue('callRequestEmail'))->send(new FeedbackMail($entry));
        } catch (Exception $e) {
            Log::info($e);
        }
        return $entry;
    }
}
