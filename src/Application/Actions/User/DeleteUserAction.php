<?php

namespace App\Application\Actions\User;

use App\Application\Middleware\Auth;
use App\Domain\Services\User\UserDeleteService;

class DeleteUserAction {
    public function __construct(
        public UserDeleteService $user
    ){}

    public function delete($id)
    {
        Auth::handle();
        
        if(!isset($id)) {
            return [
                'error' => 'ID inst set'
            ];
        }

        return $this->user->execute($id);
    }
}