<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\EntityInterface;

interface BaseRepositoryInterface {
    public function findById($id) : ?EntityInterface;
    public function findBy(array $fields) : ?EntityInterface; 
    public function save(EntityInterface $entity);
    public function update(array $data, $id): array|bool;
    public function delete($id);
    public function getAll(null|string $id);
}