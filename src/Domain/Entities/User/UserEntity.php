<?php
namespace App\Domain\Entities\User;

use App\Domain\Entities\EntityInterface;
use App\Enums\User\UserRole;
use Exception;

class UserEntity implements UserEntityInterface {

    public function __construct(
        
        public ?string $id,
        public string $role,
        public ?string $name,
        public ?string $email,
        public ?string $passwordHash
    ){}

    public function toArray(EntityInterface $entity)
    {
        return [
            'name' => $entity->name,
            'email' => $entity->email,
            'password_hash' => $entity->passwordHash,
            'role'=> $entity->role,
            'id' => $entity->id
        ];
    }
}