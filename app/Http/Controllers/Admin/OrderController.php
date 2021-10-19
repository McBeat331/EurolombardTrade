<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Services\Order\OrderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->orderService->getPaginate();
        return view('admin.order.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * @param OrderRequest $request
     * @return RedirectResponse
     */
    public function store(OrderRequest $request)
    {
        $this->orderService->add($request->all());
        return redirect()->route('admin.order.index');
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
        $entry = $this->orderService->getFind($id);
        return view('admin.order.update', compact('entry'));
    }

    /**
     * @param OrderRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(OrderRequest $request, $id)
    {
        $this->orderService->edit($id,$request->all());
        return redirect()->route('admin.order.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->orderService->delete($id);
        return redirect()->route('admin.order.index');
    }
}
