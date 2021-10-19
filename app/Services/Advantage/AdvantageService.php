<?php

namespace App\Services\Advantage;

use App\Models\Advantage;
use Illuminate\Support\Facades\App;

class AdvantageService{

    public $advantageModel;
    public $locale;

    public function __construct(Advantage $advantageModel)
    {
        $this->advantageModel = $advantageModel;
        $this->locale = App::currentLocale();
    }

    /**
     * @param $slug
     * @param array $relations
     * @return mixed
     */
    public function getBySlug($slug, $relations = [])
    {
        return $this->advantageModel->where("slug->{$this->locale}", $slug)->with($relations)->firstOrFail();
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = [])
    {
        return $this->advantageModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = [])
    {
        return $this->advantageModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getHome($relations = [])
    {
        return $this->advantageModel->with($relations)->orderBy('sort','ASC')->limit(4)->get();
    }
    /**
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginate($relations = [])
    {
        return $this->advantageModel->with($relations)->paginate(Advantage::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->advantageModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->advantageModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->advantageModel->where('id', $id)->delete();
    }

}
