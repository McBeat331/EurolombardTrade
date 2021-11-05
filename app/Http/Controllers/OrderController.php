<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderClientRequest;
use App\Job\AccountJob;
use App\Job\RateJob;
use App\Mail\OrderMail;
use App\Services\Order\OrderService;
use App\Services\Setting\SettingService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private $orderService;
    private $rateJob;
    private $settingService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService,RateJob $rateJob,SettingService $settingService)
    {
        $this->orderService = $orderService;
        $this->rateJob = $rateJob;
        $this->settingService = $settingService;
    }

    public function add(OrderClientRequest $request)
    {
        $data = $this->rateJob->addCityToData($request->all());
        $order = $this->orderService->add($request->all());

        $this->rateJob->saveRateAfterOrder($data['rate_id']);

        $request->session()->put('order-last-id', $order->id);
        $request->session()->flash('alert-success', '');


        try {
            Mail::to($this->settingService->getFieldValue('rateRequesEmail'))->send(new OrderMail($order));
        } catch (Exception $e) {
            Log::info($e);
        }

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
