<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Job\ImageJob;
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
    private $imageJob;

    /**
     * ServiceController constructor.
     * @param ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService, ImageJob $imageJob)
    {
        $this->serviceService = $serviceService;
        $this->imageJob = $imageJob;
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
        $data = $this->bruteForceRequest($request);
        $this->serviceService->add($data);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
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
        $data = $this->bruteForceRequest($request);
        $this->serviceService->edit($id,$data);
        $request->session()->flash('alert-success', 'Запись успешно изменена!');
        return redirect()->route('admin.service.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->serviceService->delete($id);
        request()->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('admin.service.index');
    }


    private function bruteForceRequest($request)
    {
        $data = $request->all();
        if($request->hasFile('image')) {
            $data['image'] = $this->imageJob->upload($request->file('image'), $this->serviceService->serviceModel->getTable(), true);
        }
        return $data;
    }
}
