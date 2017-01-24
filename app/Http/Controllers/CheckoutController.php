<?php

namespace DOLucasDelivery\Http\Controllers;

use Illuminate\Http\Request;

use DOLucasDelivery\Http\Requests;
use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\OrderRepository;
use DOLucasDelivery\Repositories\UserRepository;
use DOLucasDelivery\Repositories\ProductRepository;
use DOLucasDelivery\Services\OrderService;
use Auth;
use DOLucasDelivery\Http\Requests\CheckoutRequest;

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

    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $orderService
    ) {
        $this->orderRepository   = $orderRepository;
        $this->userRepository    = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService      = $orderService;
    }

    public function index()
    {
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;

        $orders = $this->orderRepository->scopeQuery(function ($query) use ($clientId) {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));
    }

    public function create()
    {
        $products = $this->productRepository->getIdNamePrice();

        return view('customer.order.create', compact('products'));
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;

        $this->orderService->create($data);

        return redirect()->route('customer.order.index');
    }
}
