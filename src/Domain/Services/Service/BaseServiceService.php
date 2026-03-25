<?php

namespace App\Domain\Services\Service;

use App\Domain\Repositories\Service\ServiceRepositoryInterface;
use App\Domain\Services\User\UserShowService;

abstract class BaseServiceService {
    public function __construct(
        public ServiceRepositoryInterface $repository,
        public UserShowService $find_user_service
    ){}
}