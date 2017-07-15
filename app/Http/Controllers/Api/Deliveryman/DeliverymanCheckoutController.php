<?php

namespace DOLucasDelivery\Http\Controllers\Api\Deliveryman;

use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\OrderRepository;
use DOLucasDelivery\Repositories\UserRepository;
use DOLucasDelivery\Services\OrderService;
use DOLucasDelivery\Models\Geo;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Http\Request;
use DOLucasDelivery\Events\GetLocationDeliveryman;

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
        return $order = $this->orderService->updateStatus($id, $idDeliveryman, $request->get('status'));
    }
    
    public function geo(Request $request, Geo $geo, $id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        $order = $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveryman);
        
        $geo->lat  = $request->get('lat');
        $geo->long = $request->get('long');
        
        event(new GetLocationDeliveryman($geo, $order));
        
        return $geo;
    }
}
