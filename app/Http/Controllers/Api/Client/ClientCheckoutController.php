<?php

namespace DOLucasDelivery\Http\Controllers\Api\Client;

use Illuminate\Http\Request;

use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\OrderRepository;
use DOLucasDelivery\Repositories\UserRepository;
use DOLucasDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use DOLucasDelivery\Http\Requests\CheckoutRequest;

class ClientCheckoutController extends Controller
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
     * @var OrderService
     */
    private $orderService;
    
    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderService $orderService
    ) {
        $this->orderRepository = $orderRepository;
        $this->userRepository  = $userRepository;
        $this->orderService    = $orderService;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        
        $clientId = $this->userRepository->find($id)->client->id;

        $orders = $this
            ->orderRepository
            ->skipPresenter(false)
            ->scopeQuery(function ($query) use ($clientId) {
                return $query->where('client_id', '=', $clientId);
            })->paginate();

        return $orders;
    }

    public function store(CheckoutRequest $request)
    {
        $id = Authorizer::getResourceOwnerId();
        
        $data = $request->all();
        $clientId = $this->userRepository->find($id)->id;
        $data['client_id'] = $clientId;

        $order = $this->orderService->create($data);
        
        return $this->orderRepository->skipPresenter(false)->find($order->id);
    }
    
    public function show($id)
    {
        return $this->orderRepository->skipPresenter(false)->find($id);
    }
}
