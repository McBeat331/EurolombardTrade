<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdvantageController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.advantage.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.advantage.update');
    }

    /**
     * @param AddressRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.advantage.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show()
    {

    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('admin.advantage.update');
    }

    /**
     * @param AddressRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.advantage.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        return redirect()->route('admin.advantage.index');
    }
}
