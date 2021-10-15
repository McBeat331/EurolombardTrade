<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Services\Address\AddressService;
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
     * AddressController constructor.
     * @param AddressService $addressService
     */
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
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
        return view('admin.address.update');
    }

    /**
     * @param AddressRequest $request
     * @return RedirectResponse
     */
    public function store(AddressRequest $request)
    {
        $this->addressService->add($request->all());
        return redirect()->route('admin.address.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $entry = $this->addressService->getFind($id);
        return view('admin.address.show', compact('entry'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $entry = $this->addressService->getFind($id);
        return view('admin.address.update', compact('entry'));
    }

    /**
     * @param AddressRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(AddressRequest $request, $id)
    {
        $this->addressService->edit($id,$request->all());
        return redirect()->route('admin.address.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->addressService->delete($id);
        return redirect()->route('admin.address.index');
    }
}
