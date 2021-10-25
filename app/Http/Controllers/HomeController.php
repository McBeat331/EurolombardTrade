<?php

namespace App\Http\Controllers;


use App\Job\RateJob;
use App\Models\Service;
use App\Services\Advantage\AdvantageService;
use App\Services\Page\PageService;
use App\Services\Rate\RateService;
use App\Services\Review\ReviewService;
use App\Services\Service\ServiceService;

class HomeController extends Controller
{

    private $serviceService;
    private $advantageService;
    private $reviewService;
    private $rateService;
    private $rateJob;

    public function __construct(
        AdvantageService $advantageService,
        ServiceService $serviceService,
        ReviewService $reviewService,
        RateService $rateService,
        RateJob $rateJob
    )
    {
        $this->advantageService = $advantageService;
        $this->serviceService = $serviceService;
        $this->reviewService = $reviewService;
        $this->rateService = $rateService;
        $this->rateJob = $rateJob;
    }

    public function main()
    {
        $services = $this->serviceService->getHome();
        $advantages = $this->advantageService->getHome();
        $reviews = $this->reviewService->getHome();


        //ajax setSelectedCity
        $citySelected = $this->rateJob->selectedCity();
        $rates = $this->rateService->getRatesByCity($citySelected);
        return view('home', compact('rates','services','advantages','reviews'));

        /*dd(
            $rates,
            $services,
            $advantages,
            $reviews
        );*/
    }
}
