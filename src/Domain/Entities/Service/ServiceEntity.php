<?php

namespace App\Domain\Entities\Service;

use App\Domain\Entities\EntityInterface;
use App\Domain\Entities\Service\ServiceEntityInterface;

class ServiceEntity implements ServiceEntityInterface{
    public function __construct(
        public ?string $id,
        public ?string $provider_id,
        public ?string $name,
        public ?string $description,
        public ?float $price,
        public ?int $duration_minutes,
    ){}

    public function toArray(EntityInterface $entity)
    {
        return [
            'id' => $entity->id,
            'provider_id' => $entity->provider_id,
            'name' => $entity->name,
            'description' => $entity->description,
            'price' => $entity->price,
            'duration_minutes' => $entity->duration_minutes
        ];
    }
}