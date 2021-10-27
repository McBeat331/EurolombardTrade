<?php

namespace App\Services\Rate;

use App\Models\Rate;
use App\Services\City\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RateService{

    private $rateModel;

    private const RATE_TIME_CACHE = 60*60;

    public function __construct(Rate $rateModel)
    {
        $this->rateModel = $rateModel;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = ['city'])
    {
        return $this->rateModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = ['city'])
    {
        return $this->rateModel->with($relations)->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->rateModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->rateModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->rateModel->where('id', $id)->delete();
    }
}
