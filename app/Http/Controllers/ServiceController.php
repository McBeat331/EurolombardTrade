<?php

namespace App\Http\Controllers;


use App\Services\Advantage\AdvantageService;
use App\Services\Service\ServiceService;

class ServiceController extends Controller
{
    public $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
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
}
