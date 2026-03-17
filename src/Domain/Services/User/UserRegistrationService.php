<?php

namespace App\Domain\Services\User;

use App\Domain\Services\User\BaseUserService;
use App\Domain\Entities\User\UserEntity;

class UserRegistrationService extends BaseUserService {

    public function execute($params) {
        $user = $this->repository->findBy(['email' => $params['email']]);

        if(!empty($user)) {
            return ['error' => 'User already exists'];
        }

        $user = new UserEntity('',$params['role'],$params['name'],$params['email'],$params['passwordHash']);

        return $this->repository->save($user);
    }
}