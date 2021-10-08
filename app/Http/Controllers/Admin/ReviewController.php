<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Services\Review\ReviewService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * @var ReviewService
     */
    private $reviewService;

    /**
     * ReviewController constructor.
     * @param ReviewService $reviewService
     */
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->reviewService->getPaginate();
        return view('admin.review.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.review.create');
    }

    /**
     * @param ReviewRequest $request
     * @return RedirectResponse
     */
    public function store(ReviewRequest $request)
    {
        $this->reviewService->add($request->all());
        return redirect()->route('admin.review.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $entry = $this->reviewService->getFind($id);
        return view('admin.review.show', compact('entry'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $entry = $this->reviewService->getFind($id);
        return view('admin.review.update', compact('entry'));
    }

    /**
     * @param ReviewRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ReviewRequest $request, $id)
    {
        $this->reviewService->edit($id,$request->all());
        return redirect()->route('admin.review.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->reviewService->delete($id);
        return redirect()->route('admin.review.index');
    }
}
