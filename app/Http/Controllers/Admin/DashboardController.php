<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use App\Services\Review\ReviewService;
use App\Services\User\UserService;


class DashboardController extends Controller
{
    protected $orderService;
    protected $userService;
    protected $reviewService;

    public function __construct(
        OrderService $orderService,
        UserService $userService,
        ReviewService $reviewService
    )
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllCount();
        $ordersCountLastTenDays = $this->orderService->getLastTenDaysCount();
        $ordersCount = $this->orderService->getAllCount();
        $usersCount = $this->userService->getAllCount();
        $reviewsCount = $this->reviewService->getAllCount();

        return view('admin.dashboard.index', compact('orders','ordersCount','ordersCountLastTenDays','usersCount','reviewsCount'));
    }
}
