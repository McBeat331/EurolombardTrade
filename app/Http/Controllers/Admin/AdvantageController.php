<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvantageRequest;
use App\Job\ImageJob;
use App\Services\Advantage\AdvantageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdvantageController extends Controller
{
    /**
     * @var Advantage
     */
    private $advantageService;
    private $imageJob;

    /**
     * @param AdvantageService $advantageService
     * @param ImageJob $imageJob
     */
    public function __construct(AdvantageService $advantageService,ImageJob $imageJob)
    {
        $this->advantageService = $advantageService;
        $this->imageJob = $imageJob;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->advantageService->getAll();
        return view('admin.advantage.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.advantage.update');
    }

    /**
     * @param AdvantageRequest $request
     * @return RedirectResponse
     */
    public function store(AdvantageRequest $request)
    {
        $data = $this->bruteForceRequest($request);
        $this->advantageService->add($data);
        return redirect()->route('admin.advantage.index');
    }

    /**
     * @param $id
     */
    public function show($id){}

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $entry = $this->advantageService->getFind($id);
        return view('admin.advantage.update', compact('entry'));
    }

    /**
     * @param AdvantageRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(AdvantageRequest $request, $id)
    {
        $data = $this->bruteForceRequest($request);
        $this->advantageService->edit($id,$data);
        return redirect()->route('admin.advantage.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->advantageService->delete($id);
        return redirect()->route('admin.advantage.index');
    }


    private function bruteForceRequest($request)
    {
        $data = $request->all();
        if($request->hasFile('image')) {
            $data['image'] = $this->imageJob->upload($request->file('image'), $this->advantageService->advantageModel->getTable());
        }
        return $data;
    }
}
