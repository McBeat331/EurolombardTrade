<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Services\Service\ServiceService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    /**
     * @var ServiceService
     */
    private $serviceService;

    /**
     * ServiceController constructor.
     * @param ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->serviceService->getAll();
        return view('admin.service.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.service.update');
    }

    /**
     * @param ServiceRequest $request
     * @return RedirectResponse
     */
    public function store(ServiceRequest $request)
    {
        $this->serviceService->add($request->all());
        return redirect()->route('admin.service.index');
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
        $entry = $this->serviceService->getFind($id);
        return view('admin.service.update', compact('entry'));
    }

    /**
     * @param ServiceRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ServiceRequest $request, $id)
    {
        $this->serviceService->edit($id,$request->all());
        return redirect()->route('admin.service.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->serviceService->delete($id);
        return redirect()->route('admin.service.index');
    }
}
