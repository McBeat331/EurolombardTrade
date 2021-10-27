<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Job\AccountJob;
use App\Job\RateJob;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    private $orderService;
    private $rateJob;
    private $accountJob;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService,RateJob $rateJob,AccountJob $accountJob)
    {
        $this->orderService = $orderService;
        $this->rateJob = $rateJob;
        $this->accountJob = $accountJob;
    }

    public function add(OrderRequest $request)
    {
        $order = $this->orderService->add($request->all());
        $this->rateJob->saveRateAfterOrder();

        $request->session()->put('order-last-id', $order->id);
        $request->session()->flash('alert-success', '');

    }

    public function show()
    {
        if(request()->session()->has('order-last-id')){
            $order_id = request()->session()->get('order-last-id');
            $order = $this->orderService->getFind($order_id);

            dd($order);
            // return view();

        }
        abort(404);

    }

    public function delete($id)
    {
        $this->orderService->delete($id);

        session()->flash('alert-success', '');

        return redirect()->back();
    }
}
