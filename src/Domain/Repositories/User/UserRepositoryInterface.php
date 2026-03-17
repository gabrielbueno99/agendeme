<?php

namespace App\Domain\Repositories\User;

use App\Domain\Repositories\BaseRepositoryInterface;
use App\Domain\Entities\User\UserEntity;

interface UserRepositoryInterface extends BaseRepositoryInterface {
    public function findById($id) : ?UserEntity;
    public function findBy(array $fields) : ?UserEntity; 
    public function save(UserEntity $user);
}