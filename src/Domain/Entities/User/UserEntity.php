<?php
namespace App\Domain\Entities\User;
use Exception;

class UserEntity {

    public function __construct(
        public readonly ?string $id,
        private ?string $role,
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $passwordHash
    ){}

    public function setRole($role)
    {
        if($role !== 'client' && $role !== 'provider') {
            return throw new Exception('Error Processing Request: Role '.$role.' is not a valid rule', 1);
        }

        $this->role = $role;
    }

    public function getRole($role)
    {
        return $this->role;
    }
}