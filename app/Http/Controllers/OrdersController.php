<?php

namespace DOLucasDelivery\Http\Controllers;

use Illuminate\Http\Request;

use DOLucasDelivery\Http\Requests;
use DOLucasDelivery\Http\Requests\AdminCategoryRequest;
use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\OrderRepository;
use DOLucasDelivery\Repositories\UserRepository;

class OrdersController extends Controller
{
    
    /**
     * @var OrderRepository
     */
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $orders = $this->repository->paginate();

        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id, UserRepository $userRepository)
    {
        $listStatus = [
            0 => 'Pending',
            1 => 'On way',
            2 => 'Delivered',
            3 => 'Canceled'
        ];

        $order = $this->repository->find($id);

        $deliveryman = $userRepository->getDeliveryMan();

        return view('admin.orders.edit', compact('order', 'listStatus', 'deliveryman'));
    }

    public function update(Request $request, $id)
    {
        $all = $request->all();

        $this->repository->update($all, $id);

        return redirect()->route('admin.orders.index');
    }
}
