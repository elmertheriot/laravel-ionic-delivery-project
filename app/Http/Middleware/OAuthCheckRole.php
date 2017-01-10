<?php

namespace DOLucasDelivery\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use DOLucasDelivery\Repositories\UserRepository;

class OAuthCheckRole
{

    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  IlluminateHttpRequest  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $id = Authorizer::getResourceOwnerId();
        $user = $this->userRepository->find($id);
        
        if ($user->role != $role) {
            abort(403, 'Access Forbidden');
        }
        
        return $next($request);
    }
}
