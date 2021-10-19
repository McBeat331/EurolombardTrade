<?php

namespace App\Http\Controllers;


use App\Http\Requests\ReviewRequest;
use App\Services\Review\ReviewService;

class ReviewController extends Controller
{

    public $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        $entries = $this->reviewService->getPaginate();
        dd($entries);
    }

    public function store(ReviewRequest $request)
    {
        $this->reviewService->add($request->all());

//        return redirect()->route();
    }
}
