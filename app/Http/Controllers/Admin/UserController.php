<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\User\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->userService->getPaginate();
        return view('admin.user.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $this->userService->add($request->all());
        $request->session()->flash('alert-success', '');
        return redirect()->route('admin.user.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $entry = $this->userService->getFind($id);
        return view('admin.user.show', compact('entry'));
    }

    /**
     * @param $id
     * @return Application|View
     */
    public function edit($id)
    {
        $entry = $this->userService->getFind($id);
        return view('admin.user.update', compact('entry'));
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $this->userService->edit($id,$request->all());
        $request->session()->flash('alert-success', '');
        return redirect()->route('admin.user.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->userService->delete($id);
        $request->session()->flash('alert-success', '');
        return redirect()->route('admin.user.index');
    }
}
