<?php

namespace DOLucasDelivery\Http\Controllers\Api;

use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }
    
    public function authenticated()
    {
        $id = Authorizer::getResourceOwnerId();
        return $this->userRepository->skipPresenter(false)->find($id);
    }
}
