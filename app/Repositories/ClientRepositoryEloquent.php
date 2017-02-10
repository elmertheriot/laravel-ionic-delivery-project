<?php

namespace DOLucasDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DOLucasDelivery\Repositories\ClientRepository;
use DOLucasDelivery\Models\Client;
use DOLucasDelivery\Validators\ClientValidator;
use DOLucasDelivery\Presenters\ClientPresenter;

/**
 * Class ClientRepositoryEloquent
 * @package namespace DOLucasDelivery\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    protected $skipPresenter = true;
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
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
        return ClientPresenter::class;
    }
}
