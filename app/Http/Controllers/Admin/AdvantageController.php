<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvantageRequest;
use App\Services\Advantage\AdvantageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdvantageController extends Controller
{

    private $advantageService;

    public function __construct(AdvantageService $advantageService)
    {
        $this->advantageService = $advantageService;
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
        $this->advantageService->add($request->all());
        return redirect()->route('admin.advantage.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show()
    {

    }

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
        $this->advantageService->edit($id,$request->all());
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
}
