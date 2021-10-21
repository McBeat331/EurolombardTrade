<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $userService;
    public $userId;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->userId = Auth::user()->id;
    }

    public function profile()
    {
        $user = $this->userService->getFind($this->userId,['orders']);

        dd($user);
    }
}
