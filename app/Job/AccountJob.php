<?php

namespace App\Job;

use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AccountJob
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function attachUserToOrder($data)
    {
        if(Auth::check()){
            return array_merge($data,['user_id' => Auth::id()]);
        }

        $userEntry = $this->userService->getEmail($this->emailOptimize($data['email']));
        if($userEntry === null){
            $dataCreate = [
                'email' => $this->emailOptimize($data['email']),
                'status' => User::STATUS_NOT_REGISTER
            ];
            $userEntry = $this->userService->add($dataCreate);
        }

        return array_merge($data,['user_id' => $userEntry->id]);
    }

    private function emailOptimize($email):string
    {
        $email = trim($email);
        $email = Str::lower($email);

        return $email;
    }
}
