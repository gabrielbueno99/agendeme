<?php

namespace App\Infrastructure\Persistence\User;

use App\Domain\Entities\EntityInterface;
use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Infrastructure\Persistence\AbstractPDORepository;
use App\Domain\Entities\User\UserEntity;
class UserPDORepository extends AbstractPDORepository implements UserRepositoryInterface{
    protected $table = 'users';

    protected function mapToEntity(array $data) :EntityInterface
    {
        $user = new UserEntity(
            $data['id'],
            $data['role'],
            $data['name'],
            $data['email'],
            $data['password_hash']
        );

        return $user;
    }
}