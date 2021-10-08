<?php

namespace App\Services\Country;

use App\Models\Country;

class CountryService
{
    /**
     * @var Country
     */
    private $countryModel;

    /**
     * CountryService constructor.
     * @param Country $countryModel
     */
    public function __construct(Country $countryModel)
    {
        $this->countryModel = $countryModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->countryModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = [])
    {
        return $this->countryModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginate($relations = [])
    {
        return $this->countryModel->with($relations)->paginate(Country::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->countryModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->countryModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->countryModel->where('id', $id)->delete();
    }

}