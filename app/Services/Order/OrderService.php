<?php

namespace App\Services\Order;

use App\Models\Order;

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

    public function getFind($id, $relations = [])
    {
        return $this->orderModel
            ->where('id', $id)
            ->with($relations)
            ->firstOrFail();
    }


    public function getAll($relations = [])
    {
        return $this->orderModel
            ->with($relations)
            ->get();
    }

    public function getPaginate($relations = [])
    {
        return $this->orderModel
            ->with($relations)
            ->paginate(Order::PAGINATE);
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
}