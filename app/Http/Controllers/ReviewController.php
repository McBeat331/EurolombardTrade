<?php

namespace App\Http\Controllers;


use App\Http\Requests\ReviewRequest;
use App\Job\RateJob;
use App\Mail\ReviewMail;
use App\Notifications\ReviewNotification;
use App\Services\Review\ReviewService;
use App\Services\Setting\SettingService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{

    private $reviewService;
    private $settingService;

    public function __construct(ReviewService $reviewService, SettingService $settingService)
    {
        $this->reviewService = $reviewService;
        $this->settingService = $settingService;
    }

    public function index()
    {
        $entries = $this->reviewService->getPaginate();
        dd($entries);
    }

    public function store(ReviewRequest $request)
    {
        $entry = $this->reviewService->add($request->all());

        try {
            Mail::to($this->settingService->getFieldValue('reviewRequestEmail'))->send(new ReviewMail($entry));
            $entry->notify(new ReviewNotification());
        } catch (Exception $e) {
            Log::info($e);
        }

        return $entry;
    }
}
