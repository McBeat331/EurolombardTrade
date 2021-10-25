<?php

namespace App\Services\City;

use App\Models\City;

class CityService
{
    /**
     * @var City
     */
    private $cityModel;

    /**
     * CityService constructor.
     * @param City $cityModel
     */
    public function __construct(City $cityModel)
    {
        $this->cityModel = $cityModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = ['addresses','rates'])
    {
        return $this->cityModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = ['addresses','rates'])
    {
        return $this->cityModel->with($relations)->get();
    }

    public function getClient($relations = ['addresses','rates'])
    {
        return $this->cityModel->with($relations)->whereNotNull('api_id')->get();
    }


    /**
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginate($relations = ['addresses','rates'])
    {
        return $this->cityModel->with($relations)->paginate(City::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->cityModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->cityModel->where('id', $id)->first();
        return $query->update($data);
    }



    public function updateOrCreate($data)
    {
        $dataCreate = [
            'api_id' => $data['id'],
            'name'=>[
                'ru' => $data['name']
            ]
        ];
        $query = $this->cityModel->updateOrCreate(
            ['api_id'=> $data['id']],
            $dataCreate
        );
        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->cityModel->where('id', $id)->delete();
    }

}
