<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Services\Page\PageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    /**
     * @var PageService
     */
    public $pageService;

    /**
     * @param PageService $pageService
     */
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->pageService->getAll();
        return view('admin.page.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.page.update');
    }

    /**
     * @param PageRequest $request
     * @return RedirectResponse
     */
    public function store(PageRequest $request)
    {
        $this->pageService->add($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('admin.pages.index');
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
        $entry = $this->pageService->getFind($id);
        return view('admin.page.update', compact('entry'));
    }

    /**
     * @param PageRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(PageRequest $request, $id)
    {
        $this->pageService->edit($id,$request->all());
        $request->session()->flash('alert-success', 'Запись успешно изменена!');
        return redirect()->route('admin.pages.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->pageService->delete($id);
        request()->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('admin.pages.index');
    }
}
