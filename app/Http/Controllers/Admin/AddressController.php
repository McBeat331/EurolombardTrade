<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Services\Address\AddressService;
use App\Services\City\CityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AddressController extends Controller
{
    /**
     * @var AddressService
     */
    private $addressService;

    /**
     * @var CityService
     */
    private $cityService;

    /**
     * @param AddressService $addressService
     * @param CityService $cityService
     */
    public function __construct(
        AddressService $addressService,
        CityService $cityService
    )
    {
        $this->addressService = $addressService;
        $this->cityService = $cityService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->addressService->getAll();
        return view('admin.address.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $cities = $this->cityService->getAll([]);
        return view('admin.address.update', compact('cities'));
    }

    /**
     * @param AddressRequest $request
     * @return RedirectResponse
     */
    public function store(AddressRequest $request)
    {
        $this->addressService->add($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('admin.address.index');
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
        $entry = $this->addressService->getFind($id);
        $cities = $this->cityService->getAll([]);
        return view('admin.address.update', compact('entry','cities'));
    }

    /**
     * @param AddressRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(AddressRequest $request, $id)
    {
        $this->addressService->edit($id,$request->all());
        $request->session()->flash('alert-success', 'Запись успешно изменена!');
        return redirect()->route('admin.address.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->addressService->delete($id);
        request()->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('admin.address.index');
    }
}
