<?php

namespace App\Services\Page;

use App\Models\Page;

class PageService
{
    /**
     * @var Page
     */
    private $pageModel;

    /**
     * PageService constructor.
     * @param Page $postModel
     */
    public function __construct(Page $pageModel)
    {
        $this->pageModel = $pageModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->pageModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = [])
    {
        return $this->pageModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getPaginate($relations = [])
    {
        return $this->pageModel->with($relations)->paginate(Page::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->pageModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->pageModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->pageModel->where('id', $id)->delete();
    }

}
