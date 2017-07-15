<?php

namespace DOLucasDelivery\Repositories;

use DOLucasDelivery\Models\Coupon;
use DOLucasDelivery\Presenters\CouponPresenter;
use DOLucasDelivery\Repositories\CouponRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CouponRepositoryEloquent
 * @package namespace DOLucasDelivery\Repositories;
 */
class CouponRepositoryEloquent extends BaseRepository implements CouponRepository
{
    
    protected $skipPresenter = true;
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Coupon::class;
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
        return CouponPresenter::class;
    }
    
    public function findByCode($code)
    {        
        $result = $this
            ->model
            ->where('code', $code)
            ->where('used', 0)
            ->first();
        
        if ($result) {
            return $this->parserResult($result);    
        }
        
        throw (new ModelNotFoundException())->setModel($this->model());
    }
}
