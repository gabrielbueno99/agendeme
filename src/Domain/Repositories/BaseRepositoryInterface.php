<?php

namespace App\Domain\Repositories;

interface BaseRepositoryInterface {
    public function find($fields);
}