<?php
namespace App\Domain\Entities;

interface EntityInterface {
    public function toArray(EntityInterface $entity);
    // public function checkRole($role);
}