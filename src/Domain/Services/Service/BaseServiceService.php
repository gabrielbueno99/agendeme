<?php

namespace App\Domain\Services\Service;

use App\Domain\Repositories\Service\ServiceRepositoryInterface;
use App\Domain\Services\User\UserShowService;

abstract class BaseServiceService {
    public function __construct(
        public ServiceRepositoryInterface $repository,
        public UserShowService $find_user_service
    ){}

    public function verifyUser($id)
    {
        $user = $this->find_user_service->execute($id);

        if(empty($user)) {
            http_response_code(404);
            return [
                'error' => 'User does not exists'
            ];
        }

        if($user->role !== 'prestador') {
            http_response_code(401);
            
            return [
                'error' => 'This user does not have permission to get a service'
            ];
        }

        return $user;
    }
}