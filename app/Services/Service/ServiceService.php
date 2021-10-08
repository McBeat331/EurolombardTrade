<?php

namespace App\Services\Service;

use App\Models\Service;

class ServiceService
{
    /**
     * @var Service
     */
    private $serviceModel;

    /**
     * ServiceService constructor.
     * @param Service $serviceModel
     */
    public function __construct(Service $serviceModel)
    {
        $this->serviceModel = $serviceModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->serviceModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = [])
    {
        return $this->serviceModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginate($relations = [])
    {
        return $this->serviceModel->with($relations)->paginate(Service::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->serviceModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->serviceModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->serviceModel->where('id', $id)->delete();
    }

}