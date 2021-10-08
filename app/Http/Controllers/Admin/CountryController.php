<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Services\Country\CountryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CountryController extends Controller
{
    /**
     * @var CountryService
     */
    private $countryService;

    /**
     * CountryController constructor.
     * @param CountryService $countryService
     */
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->countryService->getPaginate();
        return view('admin.country.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.country.create');
    }

    /**
     * @param CountryRequest $request
     * @return RedirectResponse
     */
    public function store(CountryRequest $request)
    {
        $this->countryService->add($request->all());
        return redirect()->route('admin.country.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $entry = $this->countryService->getFind($id);
        return view('admin.country.show', compact('entry'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $entry = $this->countryService->getFind($id);
        return view('admin.country.update', compact('entry'));
    }

    /**
     * @param CountryRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CountryRequest $request, $id)
    {
        $this->countryService->edit($id,$request->all());
        return redirect()->route('admin.country.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->countryService->delete($id);
        return redirect()->route('admin.country.index');
    }
}
