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

    public function cleanOutput($rows)
    {
        $output = [];

        foreach ($rows as $key => $row) {
            $output[] = [
                'id' => $row['service_id'],
                'name' => $row['service_name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'duration_minutes' => $row['duration_minutes'],
                'provider' => [
                    'id' => $row['user_id'],
                    'name' => $row['provider_name'],
                    'email' => $row['provider_email'],
                    'role' => $row['provider_role']
                ]
            ];
        }

        return $output;
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

        $query = "SELECT 
            s.id AS service_id, 
            s.name AS service_name, 
            s.description, 
            s.price, 
            s.duration_minutes,
            s.created_at AS service_created_at,
            u.id AS user_id, 
            u.name AS provider_name, 
            u.email AS provider_email,
            u.role AS provider_role
            FROM {$this->table} s 
            INNER JOIN users u ON s.provider_id = u.id";

        $stmp = $this->connection->prepare($query);
        $stmp->execute();
        $rows = $stmp->fetchAll(\PDO::FETCH_ASSOC);
        $res = $this->cleanOutput($rows);
    
        return $res;

    }
}