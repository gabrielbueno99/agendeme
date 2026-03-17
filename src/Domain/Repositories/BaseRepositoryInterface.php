<?php

namespace App\Domain\Repositories;

interface BaseRepositoryInterface {
    public function show();
    public function find($fields);
}