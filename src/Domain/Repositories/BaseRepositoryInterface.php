<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\EntityInterface;

interface BaseRepositoryInterface {
    public function findById($id) : ?EntityInterface;
    public function findBy(array $fields) : ?EntityInterface; 
    public function save(EntityInterface $user);
    public function update(EntityInterface $data);
    public function delete($id);
}