<?php

namespace App\Domain\Services\User;

use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Domain\Entities\User\UserEntity;

class UserShowService {

    public function __construct(
        private UserRepositoryInterface $repository
    ){}

    public function execute($id)
    {
        return $this->repository->findById($id);
    }
}