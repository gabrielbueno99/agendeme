<?php

namespace App\Domain\Services\User;

use App\Domain\Services\User\BaseUserService;

class UserDeleteService extends BaseUserService {

    public function execute($id)
    {
        $user = $this->repository->findById($id);

        if(empty($user)) {
            return [
                'error' => 'User not found'
            ];
        }

        return $this->repository->delete($id);
    }
}