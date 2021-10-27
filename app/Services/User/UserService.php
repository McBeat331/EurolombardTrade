<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @var User
     */
    private $userModel;
    private $userId;

    /**
     * UserService constructor.
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
//        $this->userId = Auth::user()->id;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getFind($id, $relations = ['reviews','orders'])
    {
        return $this->userModel->where('id', $id)->with($relations)->firstOrFail();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getEmail($email)
    {
        return $this->userModel->where('email', $email)->first();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = ['reviews','orders'])
    {
        return $this->userModel->with($relations)->get();
    }

    /**
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginate($relations = ['reviews','orders'])
    {
        return $this->userModel->with($relations)->paginate(User::PAGINATE);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        $data = $this->passwordHash($data);
        return $this->userModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id,$data)
    {
        $query = $this->userModel->where('id', $id)->first();
        return $query->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userModel->where('id', $id)->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function roleToAdmin($id)
    {
        $query = $this->userModel->where('id', $id)->first();
        return $query->update(['is_admin', User::IS_ADMIN]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function roleToUser($id)
    {
        $query = $this->userModel->where('id', $id)->first();
        return $query->update(['is_admin', User::IS_NOT_ADMIN]);
    }

    public function getAllCount()
    {
        return $this->userModel->select('id')->count();
    }

    private function passwordHash($data){
        if(isset($data['password']) && $data['password']){
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }

}
