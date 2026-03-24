<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\EntityInterface;
use PDO;


abstract class AbstractPDORepository {
    protected $table;
    protected PDO $connection;

    public function __construct(PDO $pdo)
    {
        $this->connection = $pdo;
    }

    abstract protected function mapToEntity(array $data): EntityInterface;

    public function findById($id) : ?EntityInterface {
        $query = "SELECT * FROM {$this->table} WHERE id = {$id}";
        $stmp = $this->connection->prepare($query);
        $stmp->execute();
        $res = $stmp->fetch(\PDO::FETCH_ASSOC);

        if(empty($res)) {
            return null;
        }

        $entity = $this->mapToEntity($res);

        return $entity;
    }

    public function findBy(array $fields): ?EntityInterface
    {
        $conditions = [];
        $params = [];

        foreach($fields as $field => $value) {
            $conditions[] = "{$field} = :{$field}";
            $params[":{$field}"] = $value;
        }

        $where = implode(' AND ', $conditions);
        $query = "SELECT * FROM {$this->table} WHERE {$where}";
        $stmp = $this->connection->prepare($query);
        $stmp->execute($params);
        $res = $stmp->fetch(\PDO::FETCH_ASSOC);
        
        if(empty($res)) {
            return null;
        }

        $entity = $this->mapToEntity($res);
        return $entity;
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = {$id}";
        $stmp = $this->connection->prepare($query);
        $success = $stmp->execute();

        if($success) {
            return [
                'deleted'
            ];
        }

        return [
            'error' => 'Something went wrong'
        ];
    }

    public function save(?EntityInterface $entity)
    {
        $data = $entity->toArray($entity);
        $filterData = array_filter($data, function ($value) {
            return $value !== "id";
        }, ARRAY_FILTER_USE_KEY);
        
        $colums = array_keys($filterData);

        $placeholders = array_map(function($col){
            if($col !== "id") {
                return ':'.$col;
            }
        }, $colums);

        $query = "INSERT INTO {$this->table} (". implode(', ', $colums). ") VALUES (". implode(', ', $placeholders). ")";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($filterData);

        $id = $this->connection->lastInsertId();
        $data['id'] = $id;
        $data = $this->mapToEntity($data);
        
        return $data;
    }

    public function update(array $data, $id): array|bool
    {
        
        if(!isset($data['password_hash'])) {
            unset($data['password_hash']);
        }

        $setPart = "";
        $params = [];

        foreach ($data as $key => $value) {
            if($key !== 'id') {
                $setPart .= "{$key} = :{$key}, ";
                $params[":{$key}"] = $value;
        }   
        }

        $setPart = rtrim($setPart, ", ");
        $query = "UPDATE {$this->table} SET {$setPart} WHERE id = {$id}";
        $stmp = $this->connection->prepare($query);
        $success = $stmp->execute($params);
        
        if($success) {
            return $success;
        }

        return [
            'error' => 'Something went wrong'
        ];
    }
}