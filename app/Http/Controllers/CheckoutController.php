<?php

namespace DOLucasDelivery\Http\Controllers;

use Illuminate\Http\Request;

use DOLucasDelivery\Http\Requests;
use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\OrderRepository;
use DOLucasDelivery\Repositories\UserRepository;
use DOLucasDelivery\Repositories\ProductRepository;

class CheckoutController extends Controller
{
    
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var OrderRepository
     */
    private $userRepository;

    /**
     * @var OrderRepository
     */
    private $productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository
    ) {
        $this->orderRepository   = $orderRepository;
        $this->userRepository    = $userRepository;
        $this->productRepository = $productRepository;
    }

    public function create()
    {
        $products = $this->productRepository->listsNameId();

        return view('customer.order.create', compact('products'));
    }
}
