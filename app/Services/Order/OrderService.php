<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Support\Carbon;

class OrderService
{
    /**
     * @var Order
     */
    private $orderModel;

    /**
     * OrderService constructor.
     * @param Order $orderModel
     */
    public function __construct(Order $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function getFind($id, $relations = ['address.city','user'])
    {
        return $this->orderModel
            ->where('id', $id)
            ->with($relations)
            ->firstOrFail();
    }


    public function getAll($relations = ['address.city','user'])
    {
        return $this->orderModel
            ->with($relations)
            ->orderBy('created_at','DESC')
            ->get();
    }

    public function getPaginate($relations = ['address.city','user'])
    {
        return $this->orderModel
            ->with($relations)
            ->orderBy('created_at','DESC')
            ->paginate(Order::PAGINATE);
    }
    public function getLimit($limit = 20,$relations = ['address.city','user'])
    {
        return $this->orderModel
            ->with($relations)
            ->orderBy('created_at','DESC')
            ->limit($limit)
            ->get();
    }

    public function add($data)
    {
        return $this->orderModel->create($data);
    }

    public function edit($id,$data)
    {
        $query = $this->orderModel->where('id', $id)->first();
        return $query->update($data);
    }

    public function delete($id)
    {
        return $this->orderModel->where('id', $id)->delete();
    }

    public function getAllCount()
    {
        return $this->orderModel->select('id')->count();
    }

    public function getLastTenDaysCount()
    {
        $days = 9;
        $query = $this->orderModel->select(['id','created_at'])->where('created_at','>=',Carbon::now()->subDays($days))->get();
        $collection = collect();
        while($days >= 0){
            $collection = collect([
                    Carbon::now()->subDays($days)->format('d.m.y')
                =>
                    $query->filter(function($item) use ($days){
                        return $item->created_at->format('d.m.Y') === Carbon::now()->subDays($days)->format('d.m.Y');
                    })->count()
            ])->merge($collection);
            $days--;
        }
        return $collection->reverse();
    }

    /**
     * @param $id
     * @return false|Model
     */
    public function changeStatus($id)
    {
        $query = $this->getFind($id,[]);

        if($query->status == Order::STATUS_NOT_VERIFIED)
        {
            $query->update(['status' => Order::STATUS_TO_VERIFIED]);
            return $query;
        }
        if($query->status == Order::STATUS_TO_VERIFIED)
        {
            $query->update(['status' => Order::STATUS_NOT_VERIFIED]);
            return $query;
        }
        return false;
    }
}
