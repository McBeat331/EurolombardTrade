<?php

namespace App\Services\Address;

use App\Models\Address;

class AddressService
{
    /**
     * @var Address
     */
    private $addressModel;

    /**
     * AddressService constructor.
     * @param Address $addressModel
     */
    public function __construct(Address $addressModel)
    {
        $this->addressModel = $addressModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->addressModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = [])
    {
        return $this->addressModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginate($relations = [])
    {
        return $this->addressModel->with($relations)->paginate(Country::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->addressModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->addressModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->addressModel->where('id', $id)->delete();
    }

}