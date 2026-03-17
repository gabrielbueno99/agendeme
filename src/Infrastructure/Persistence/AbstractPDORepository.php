<?php

namespace App\Infrastructure\Persistence;
use PDO;


abstract class AbstractPDORepository {
    protected $table;
    protected PDO $connection;

    public function __construct(PDO $pdo)
    {
        $this->connection = $pdo;
    }

    public function show(){}
    public function find(){}
}