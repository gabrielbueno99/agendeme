<?php

namespace App\Domain\Repositories\RefreshToken;

use App\Domain\Repositories\BaseRepositoryInterface;
use App\Domain\Entities\EntityInterface;

interface RefreshTokenRepositoryInterface extends BaseRepositoryInterface{
    public function matchRefreshToken($data): ?array;
}