<?php

namespace App\Infrastructure\Persistence\User;

use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Infrastructure\Persistence\AbstractPDORepository;

class UserPDORepository extends AbstractPDORepository implements UserRepositoryInterface{
    protected $table = 'users';
}