<?php

namespace App\Application\Actions\User;

use Exception;
use App\Domain\Services\User\UserRegistrationService;

class CreateUserAction {
    public function __construct(
        public readonly UserRegistrationService $user
    ){}

    public function create()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if(json_last_error() !== JSON_ERROR_NONE) {
            return ['error' => 'Invalid JSON'];
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