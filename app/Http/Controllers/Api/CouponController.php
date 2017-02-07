<?php

namespace DOLucasDelivery\Http\Controllers\Api;

use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\CouponRepository;

class CouponController extends Controller
{
    /**
     * @var CouponRepository
     */
    private $couponRepository;

    public function __construct(CouponRepository $couponRepository) 
    {
        $this->couponRepository = $couponRepository;
    }
    
    public function show($code)
    {
        return $this->couponRepository->skipPresenter(false)->findByCode($code);
    }
}
