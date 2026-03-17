<?php
namespace App\Domain\Services\User;
use App\Domain\Repositories\User\UserRepositoryInterface;

class BaseUserService {
    public function __construct(
        public UserRepositoryInterface $repository
    ){}
}