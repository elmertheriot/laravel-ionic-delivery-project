<?php

namespace DOLucasDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DOLucasDelivery\Repositories\CategoryRepository;
use DOLucasDelivery\Models\Category;
use DOLucasDelivery\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace DOLucasDelivery\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
