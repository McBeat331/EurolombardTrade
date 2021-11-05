<?php

namespace App\Http\Controllers;


use App\Http\Requests\ReviewRequest;
use App\Job\RateJob;
use App\Mail\ReviewMail;
use App\Services\Review\ReviewService;
use App\Services\Setting\SettingService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{

    private $reviewService;
    private $settingService;
    private $rateJob;

    public function __construct(ReviewService $reviewService, SettingService $settingService, RateJob $rateJob)
    {
        $this->reviewService = $reviewService;
        $this->settingService = $settingService;;
        $this->rateJob = $rateJob;
    }

    public function index()
    {
        $entries = $this->reviewService->getPaginate();
        dd($entries);
    }

    public function store(ReviewRequest $request)
    {
        $data = $this->rateJob->addCityToData($request->all());
        $entry = $this->reviewService->add($data);

        try {
            Mail::to($this->settingService->getFieldValue('reviewRequestEmail'))->send(new ReviewMail($entry));
        } catch (Exception $e) {
            Log::info($e);
        }

        return $entry;
    }
}
