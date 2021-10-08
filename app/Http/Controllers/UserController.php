<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;

class UserController extends Controller
{
    public $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {

    }
}