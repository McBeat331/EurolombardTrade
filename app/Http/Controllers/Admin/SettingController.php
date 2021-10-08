<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Services\Setting\SettingService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    /**
     * @var SettingService
     */
    public $settingService;

    /**
     * SettingController constructor.
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->settingService->getAll();
        return view('admin.setting.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.setting.create');
    }

    /**
     * @param SettingService $request
     * @return RedirectResponse
     */
    public function store(SettingService $request)
    {
        $this->settingService->attach($request->all());
        return redirect()->route('admin.setting.index');
    }

    /**
     * @param $field
     * @return Application|Factory|View
     */
    public function show($field)
    {
        $entry = $this->settingService->getFind($field);
        return view('admin.setting.show', compact('entry'));
    }

    /**
     * @param $field
     * @return Application|Factory|View
     */
    public function edit($field)
    {
        $entry = $this->settingService->getField($field);
        return view('admin.setting.update', compact('entry'));
    }

    /**
     * @param SettingRequest $request
     * @return RedirectResponse
     */
    public function update(SettingRequest $request)
    {
        $this->settingService->attach($request->all());
        return redirect()->route('admin.setting.index');
    }

    /**
     * @param $field
     * @return RedirectResponse
     */
    public function destroy($field)
    {
        $this->settingService->delete($field);
        return redirect()->route('admin.setting.index');
    }
}
