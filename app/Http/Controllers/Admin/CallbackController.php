<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\PageRequest;
use App\Services\Communication\CallbackServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CallbackController extends Controller
{
    /**
     * @var CallbackServices
     */
    public $callbackServices;

    /**
     * @param CallbackServices $callbackServices
     */
    public function __construct(CallbackServices $callbackServices)
    {
        $this->callbackServices = $callbackServices;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->callbackServices->getPaginate();
        return view('admin.callback.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.callback.update');
    }

    /**
     * @param PageRequest $request
     * @return RedirectResponse
     */
    public function store(PageRequest $request)
    {
        $this->callbackServices->add($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('admin.callback.index');
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
        $entry = $this->callbackServices->getFind($id);
        return view('admin.callback.update', compact('entry'));
    }

    /**
     * @param PageRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(PageRequest $request, $id)
    {
        $this->callbackServices->edit($id,$request->all());
        $request->session()->flash('alert-success', 'Запись успешно изменена!');
        return redirect()->route('admin.callback.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->callbackServices->delete($id);
        request()->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('admin.callback.index');
    }


    public function changeStatus(ChangeStatusRequest $request)
    {
        return $this->callbackServices->changeStatus($request->get('id'));
    }
}
