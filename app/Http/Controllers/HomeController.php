<?php

namespace App\Http\Controllers;


use App\Models\Service;
use App\Services\Advantage\AdvantageService;
use App\Services\Page\PageService;
use App\Services\Review\ReviewService;
use App\Services\Service\ServiceService;

class HomeController extends Controller
{

    private $serviceService;
    private $advantageService;
    private $reviewService;

    public function __construct(
        ServiceService $serviceService,
        AdvantageService $advantageService,
        ReviewService $reviewService
    )
    {
        $this->serviceService = $serviceService;
        $this->advantageService = $advantageService;
        $this->reviewService = $reviewService;
    }

    public function main()
    {
        dd($this->serviceService->getFind(8)->title);
        $services = $this->serviceService->getHome();
        $advantages = $this->advantageService->getHome();
        $reviews = $this->reviewService->getHome();

        dd(
            $services,
            $advantages,
            $reviews
        );
    }
}
