<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\Post\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    public $postService;

    /**
     * PostController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $entries = $this->postService->getPaginate();
        return view('admin.post.index', compact('entries'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $this->postService->add($request->all());
        return redirect()->route('admin.post.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $entry = $this->postService->getFind($id);
        return view('admin.post.show', compact('entry'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $entry = $this->postService->getFind($id);
        return view('admin.post.update', compact('entry'));
    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        $this->postService->edit($id,$request->all());
        return redirect()->route('admin.post.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->postService->delete($id);
        return redirect()->route('admin.post.index');
    }
}
