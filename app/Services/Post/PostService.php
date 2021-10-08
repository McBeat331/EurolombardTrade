<?php

namespace App\Services\Post;

use App\Models\Post;

class PostService
{
    /**
     * @var Post
     */
    private $postModel;

    /**
     * PageService constructor.
     * @param Post $postModel
     */
    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->postModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = [])
    {
        return $this->postModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getPaginate($relations = [])
    {
        return $this->postModel->with($relations)->paginate(Post::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->postModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->postModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->postModel->where('id', $id)->delete();
    }

}