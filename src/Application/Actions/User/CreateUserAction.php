<?php

namespace App\Application\Actions\User;

use App\Application\Actions\BaseAction;
use Exception;
use App\Domain\Services\User\UserRegistrationService;

class CreateUserAction extends BaseAction {
    public function __construct(
        public readonly UserRegistrationService $user
    ){}

    public function create()
    {
        $data = $this->verifyBodyContent();

        if(isset($data['error'])) {
            return $data;
        }

        if(empty($data['name']) || empty($data['email']) || empty($data['role']) || empty($data['passwordHash'])) {
            return [
                'error' => 'Invalid data',
                'message' => 'empty values',
                'data' => $data
            ];
        }

        if(strlen($data['passwordHash']) < 8) {
            return [
                'error' => 'Invalid data',
                'message' => 'Short password',
                'data' => $data
            ];
        }

        return $this->user->execute($data);
    }
}