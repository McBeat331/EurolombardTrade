<?php

namespace App\Services\Service;

use App\Models\Service;
use Illuminate\Support\Facades\App;

class ServiceService
{
    /**
     * @var Service
     */
    public $serviceModel;
    public $locale;

    /**
     * ServiceService constructor.
     * @param Service $serviceModel
     */
    public function __construct(Service $serviceModel)
    {
        $this->serviceModel = $serviceModel;
        $this->locale = App::currentLocale();
    }

    /**
     * @param $slug
     * @param array $relations
     * @return mixed
     */
    public function getBySlug($slug, $relations = [])
    {
        return $this->serviceModel->where("slug->{$this->locale}", $slug)->with($relations)->firstOrFail();
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

    public function getHome($relations = [])
    {
        return $this->serviceModel->with($relations)->orderBy('created_at','DESC')->limit(3)->get();
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
