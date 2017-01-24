<?php

namespace DOLucasDelivery\Http\Controllers\Api\Deliveryman;

use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\OrderRepository;
use DOLucasDelivery\Repositories\UserRepository;
use DOLucasDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Http\Request;

class DeliverymanCheckoutController extends Controller
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

    /**
     * @var array
     */
    private $with = ['client', 'coupon', 'items'];
    
    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderService $orderService
    ) {
        $this->orderRepository   = $orderRepository;
        $this->userRepository    = $userRepository;
        $this->orderService      = $orderService;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $orders = $this
            ->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function ($query) use ($id) {
                return $query->where('user_deliveryman_id', '=', $id);
            })->paginate();

        return $orders;
    }
    
    public function show($id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        return $this
            ->orderRepository
            ->skipPresenter(false)
            ->getByIdAndDeliveryman($id, $idDeliveryman);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        $order = $this->orderService->updateStatus($id, $idDeliveryman, $request->get('status'));
        if ($order) {
            return $this->orderRepository->find($order->id);
        }
        abort(400, 'Order not found');
    }
}
