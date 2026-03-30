<?php

namespace App\Domain\Services\Service;

class ShowServiceService extends BaseServiceService {
    public function execute($id)
    {
        return $this->repository->findById($id);
    }
}