<?php

namespace App\Domain\Services\User;
use App\Domain\Services\User\BaseUserService;

class UserUpdateService extends BaseUserService {
    public function execute($data, $id)
    {
        $user = $this->repository->findById($id);

        if(empty($user)) {
            return [
                'error' => 'Invalid data',
                'message' => 'User not found',
            ];            
        }

        $hasUser = $this->repository->findBy(['email' => $data['email']]);

        if(!empty($hasUser) && $hasUser->id !== $id ) {
            return [
                'error' => 'Invalid data',
                'message' => 'Email already in use',
            ];
        }
        
        if(!isset($data['role']) && ($data['role'] !== 'cliente' || $data['role'] !== 'prestador')) {
            return [
                'error' => 'Invalid data',
                'message' => 'Role not matched whit default roles'
            ];
        }
 
        return $this->repository->update($data, $id);
    }
}