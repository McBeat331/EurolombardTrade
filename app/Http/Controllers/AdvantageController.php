<?php

namespace App\Http\Controllers;


use App\Services\Advantage\AdvantageService;

class AdvantageController extends Controller
{
    public $advantageService;

    public function __construct(AdvantageService $advantageService)
    {
        $this->advantageService = $advantageService;
    }

    public function index()
    {
        $entries = $this->advantageService->getPaginate();
        dd($entries);
    }

    public function show($slug)
    {
        $entry = $this->advantageService->getBySlug($slug);
        dd($entry);
    }
}
