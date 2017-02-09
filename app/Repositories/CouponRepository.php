<?php

namespace DOLucasDelivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CouponRepository
 * @package namespace DOLucasDelivery\Repositories;
 */
interface CouponRepository extends RepositoryInterface
{
    public function findByCode($code);
}
