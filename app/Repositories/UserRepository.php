<?php

namespace DOLucasDelivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace DOLucasDelivery\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function updateDeviceToken($id, $deviceToken);
}
