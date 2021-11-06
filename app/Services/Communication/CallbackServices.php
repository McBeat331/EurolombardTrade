<?php

namespace App\Services\Communication;

use App\Models\Callback;

class CallbackServices
{
    /**
     * @var Callback
     */
    private $callbackModel;

    /**
     * @param Callback $callbackModel
     */
    public function __construct(Callback $callbackModel)
    {
        $this->callbackModel = $callbackModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->callbackModel->where('id', $id)->with($relations)->firstOrFail();
    }
    public function getUnreadCount()
    {
        return $this->callbackModel
            ->where('status', 0)
            ->count();
    }
    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = [])
    {
        return $this->callbackModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getPaginate($relations = [])
    {
        return $this->callbackModel->with($relations)->paginate(Callback::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->callbackModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->callbackModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->callbackModel->where('id', $id)->delete();
    }


    public function changeStatus($id)
    {
        $query = $this->getFind($id,[]);

        if($query->status == Callback::STATUS_NOT_VERIFIED)
        {
            $query->update(['status' => Callback::STATUS_TO_VERIFIED]);
            return $query;
        }
        if($query->status == Callback::STATUS_TO_VERIFIED)
        {
            $query->update(['status' => Callback::STATUS_NOT_VERIFIED]);
            return $query;
        }
        return false;
    }

}
