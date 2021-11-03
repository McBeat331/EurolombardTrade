<?php

namespace App\Http\Controllers;


use App\Job\RateJob;
use App\Services\Advantage\AdvantageService;
use App\Services\Review\ReviewService;
use App\Services\Service\ServiceService;

class HomeController extends Controller
{

    private $serviceService;
    private $advantageService;
    private $reviewService;
    private $rateJob;

    public function __construct(
        AdvantageService $advantageService,
        ServiceService $serviceService,
        ReviewService $reviewService,
        RateJob $rateJob
    )
    {
        $this->advantageService = $advantageService;
        $this->serviceService = $serviceService;
        $this->reviewService = $reviewService;
        $this->rateJob = $rateJob;
    }

    public function main()
    {
        $services = $this->serviceService->getHome();
        $advantages = $this->advantageService->getHome();
        $reviews = $this->reviewService->getHome();

        /*dd(
            addresses(),
            $rates,
            $services,
            $advantages,
            $reviews
        );*/
        return view('home', compact('services', 'advantages', 'reviews'));
    }
}
