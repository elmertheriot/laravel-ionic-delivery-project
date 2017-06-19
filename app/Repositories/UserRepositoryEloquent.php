<?php

namespace DOLucasDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DOLucasDelivery\Repositories\UserRepository;
use DOLucasDelivery\Models\User;
use DOLucasDelivery\Validators\UserValidator;
use DOLucasDelivery\Presenters\UserPresenter;

/**
 * Class UserRepositoryEloquent
 * @package namespace DOLucasDelivery\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    
    protected $skipPresenter = true;
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function getDeliveryMan()
    {
        return $this->model->where(['role' => 'deliveryman'])->lists('name', 'id');
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
        return UserPresenter::class;
    }
    
    public function updateDeviceToken($id, $deviceToken)
    {
        $model = $this->model->find($id);
        $model->device_token = $deviceToken;
        $model->save();
        
        return $this->parserResult($model);
    }
}
