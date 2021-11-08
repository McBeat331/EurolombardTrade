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
    public function getFind($id, $relations = ['city'])
    {
        return $this->addressModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = ['city'])
    {
        return $this->addressModel->with($relations)->get();
    }


    public function getClientFirst($relations = ['city'])
    {
        return $this->addressModel->with($relations)->where('published', 1)->first();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginate($relations = ['city'])
    {
        return $this->addressModel->with($relations)->paginate(Address::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        if (!isset($data['round_the_clock'])) {
            $data['round_the_clock'] = 0;
        }
        else
        {
            $data['round_the_clock'] = 1;
        }
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
        if (!isset($data['round_the_clock'])) {
            $data['round_the_clock'] = 0;
        }
        else
        {
            $data['round_the_clock'] = 1;
        }
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
