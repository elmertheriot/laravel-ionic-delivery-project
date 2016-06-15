<?php

namespace DOLucasDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DOLucasDelivery\Repositories\OrderItemRepository;
use DOLucasDelivery\Models\OrderItem;
use DOLucasDelivery\Validators\OrderItemValidator;

/**
 * Class OrderItemRepositoryEloquent
 * @package namespace DOLucasDelivery\Repositories;
 */
class OrderItemRepositoryEloquent extends BaseRepository implements OrderItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
