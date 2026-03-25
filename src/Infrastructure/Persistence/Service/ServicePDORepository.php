<?php

namespace App\Infrastructure\Persistence\Service;

use App\Domain\Entities\EntityInterface;
use App\Domain\Entities\Service\ServiceEntity;
use App\Domain\Repositories\Service\ServiceRepositoryInterface;
use App\Infrastructure\Persistence\AbstractPDORepository;

class ServicePDORepository extends AbstractPDORepository implements ServiceRepositoryInterface {
    protected $table = 'services';

    public function mapToEntity(array $data): EntityInterface
    {
        $entity = new ServiceEntity(
            $data['id'],
            $data['provider_id'],
            $data['name'],
            $data['description'],
            $data['price'],
            $data['duration_minutes']
        );

        return $entity;
    }

    public function getAll($id)
    {
        if(!empty($id)) {

            $query = "SELECT s.* 
                  FROM {$this->table} s 
                  INNER JOIN users u ON s.provider_id = u.id 
                  WHERE s.provider_id = ?";
            $stmp = $this->connection->prepare($query);
            $stmp->execute([
                $id
            ]);
            $res = $stmp->fetchAll(\PDO::FETCH_ASSOC);
    
            return $res;
        }

        $query = "SELECT * FROM {$this->table}";
        $stmp = $this->connection->prepare($query);
        $stmp->execute();
        $res = $stmp->fetchAll(\PDO::FETCH_ASSOC);
    
        return $res;

    }
}