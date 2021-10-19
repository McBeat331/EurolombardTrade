<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Services\City\CityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CityController extends Controller
{
    /**
     * @var CityService
     */
    private $cityService;

    /**
     * CityController constructor.
     * @param CityService $cityService
     */
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->cityService->getPaginate();
        return view('admin.city.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.city.update');
    }

    /**
     * @param CityRequest $request
     * @return RedirectResponse
     */
    public function store(CityRequest $request)
    {
        $this->cityService->add($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('admin.city.index');
    }

    /**
     * @param $id
     *
    public function show($id){}

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $entry = $this->cityService->getFind($id);
        return view('admin.city.update', compact('entry'));
    }

    /**
     * @param CityRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CityRequest $request, $id)
    {
        $this->cityService->edit($id,$request->all());
        $request->session()->flash('alert-success', 'Запись успешно изменена!');
        return redirect()->route('admin.city.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->cityService->delete($id);
        request()->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('admin.city.index');
    }
}
