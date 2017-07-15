<?php

namespace DOLucasDelivery\Repositories;

use DOLucasDelivery\Models\Order;
use DOLucasDelivery\Repositories\OrderRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use DOLucasDelivery\Presenters\OrderPresenter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class OrderRepositoryEloquent
 * @package namespace DOLucasDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;
    
    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this
            ->model
            ->where('id', $id)
            ->where('user_deliveryman_id', $idDeliveryman)
            ->first();
        
        if ($result) {
            return $this->parserResult($result);
        }
        
        throw (new ModelNotFoundException("Order not found"))->setModel($this->model());
    }
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function presenter()
    {
        return OrderPresenter::class;
    }
}
