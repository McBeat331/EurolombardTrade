<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\PageRequest;
use App\Services\Communication\FeedbackServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FeedbackController extends Controller
{
    /**
     * @var FeedbackServices
     */
    public $feedbackServices;

    /**
     * @param FeedbackServices $feedbackServices
     */
    public function __construct(FeedbackServices $feedbackServices)
    {
        $this->feedbackServices = $feedbackServices;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->feedbackServices->getPaginate();
        return view('admin.feedback.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.feedback.update');
    }

    /**
     * @param PageRequest $request
     * @return RedirectResponse
     */
    public function store(PageRequest $request)
    {
        $this->feedbackServices->add($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('admin.feedback.index');
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
        $entry = $this->feedbackServices->getFind($id);
        return view('admin.feedback.update', compact('entry'));
    }

    /**
     * @param PageRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(PageRequest $request, $id)
    {
        $this->feedbackServices->edit($id,$request->all());
        $request->session()->flash('alert-success', 'Запись успешно изменена!');
        return redirect()->route('admin.feedback.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->feedbackServices->delete($id);
        request()->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('admin.feedback.index');
    }


    public function changeStatus(ChangeStatusRequest $request)
    {
        return $this->feedbackServices->changeStatus($request->get('id'));
    }
}
