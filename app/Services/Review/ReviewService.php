<?php

namespace App\Services\Review;

use App\Models\Review;

class ReviewService
{
    /**
     * @var Review
     */
    private $reviewModel;

    /**
     * ReviewService constructor.
     * @param Review $reviewModel
     */
    public function __construct(Review $reviewModel)
    {
        $this->reviewModel = $reviewModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->reviewModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = [])
    {
        return $this->reviewModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getPaginate($relations = [])
    {
        return $this->reviewModel->with($relations)->paginate(Review::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->reviewModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->reviewModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->reviewModel->where('id', $id)->delete();
    }

}