<?php

namespace App\Domain\Services\User;

use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Domain\Entities\User\UserEntity;
use App\Domain\Services\User\BaseUserService;

class UserShowService extends BaseUserService {

    public function execute($id)
    {
        return $this->repository->findById($id);
    }
}