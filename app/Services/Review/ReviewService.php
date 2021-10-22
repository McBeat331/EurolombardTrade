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
    public function getFind($id, $relations = ['user'])
    {
        return $this->reviewModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = ['user'])
    {
        return $this->reviewModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getHome($relations = ['user'])
    {
        return $this->reviewModel
            ->with($relations)
            ->where('status',Review::STATUS_TO_VERIFIED)
            ->orderBy('created_at','DESC')
            ->limit(4)
            ->get();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getPaginate($relations = ['user'])
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

    public function confirmStatus($id)
    {
        $query = $this->reviewModel->where('id', $id)->first();
        return $query->update(['status' => Review::STATUS_TO_VERIFIED]);
    }

    public function rejectStatus($id)
    {
        $query = $this->reviewModel->where('id', $id)->first();
        return $query->update(['status' => Review::STATUS_REJECTED]);
    }


    public function getAllCount()
    {
        return $this->reviewModel->select('id')->count();
    }
}
