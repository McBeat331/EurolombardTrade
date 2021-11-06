<?php

namespace App\Services\Communication;

use App\Models\Feedback;

class FeedbackServices
{
    /**
     * @var Feedback
     */
    private $feedbackModel;

    /**
     * @param Feedback $feedbackModel
     */
    public function __construct(Feedback $feedbackModel)
    {
        $this->feedbackModel = $feedbackModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->feedbackModel->where('id', $id)->with($relations)->firstOrFail();
    }
    public function getUnreadCount()
    {
        return $this->feedbackModel
            ->where('status', 0)
            ->count();
    }
    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = [])
    {
        return $this->feedbackModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getPaginate($relations = ['service', 'city'])
    {
        return $this->feedbackModel->with($relations)->paginate(Feedback::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->feedbackModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->feedbackModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->feedbackModel->where('id', $id)->delete();
    }



    public function changeStatus($id)
    {
        $query = $this->getFind($id,[]);

        if($query->status == Feedback::STATUS_NOT_VERIFIED)
        {
            $query->update(['status' => Feedback::STATUS_TO_VERIFIED]);
            return $query;
        }
        if($query->status == Feedback::STATUS_TO_VERIFIED)
        {
            $query->update(['status' => Feedback::STATUS_NOT_VERIFIED]);
            return $query;
        }
        return false;
    }
}
