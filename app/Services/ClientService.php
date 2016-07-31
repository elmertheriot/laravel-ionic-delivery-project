<?php

namespace DOLucasDelivery\Services;

use DOLucasDelivery\Repositories\ClientRepository;
use DOLucasDelivery\Repositories\UserRepository;

class ClientService
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param ClientRepository $clientRepository
     * @param UserRepository   $userRepository
     */
    public function __construct(
        ClientRepository $clientRepository,
        UserRepository $userRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param  array  $data
     */
    public function update(array $data, $id)
    {
        $this->clientRepository->update($data, $id);

        $user = $this->clientRepository->find($id, ['user_id']);
        $this->userRepository->update($data['user'], $user->user_id);
    }

    /**
     * @param  array  $data
     */
    public function create(array $data)
    {
        $data['user']['password'] = bcrypt('123456');
        $user = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;
        $this->clientRepository->create($data);
    }
}