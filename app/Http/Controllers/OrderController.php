<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    private $orderService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function add(OrderRequest $request)
    {
        $this->orderService->add($request->all());

        $request->session()->flash('alert-success', '');

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->orderService->delete($id);

        session()->flash('alert-success', '');

        return redirect()->back();
    }
}