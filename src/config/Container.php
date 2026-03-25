<?php

use App\Domain\Repositories\RefreshToken\RefreshTokenRepositoryInterface;
use App\Domain\Repositories\Service\ServiceRepositoryInterface;
use DI\ContainerBuilder;
use function DI\autowire;
use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Infrastructure\Persistence\RefreshToken\RefreshTokenPDORepository;
use App\Infrastructure\Persistence\Service\ServicePDORepository;
use App\Infrastructure\Persistence\User\UserPDORepository;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    // Configuração do PDO (Banco de Dados no Docker)
    \PDO::class => function () {
        $host = 'db';
        $db   = getenv('MYSQL_DATABASE');
        $user = getenv('MYSQL_USER');
        $pass = getenv('MYSQL_PASSWORD');
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        return new \PDO($dsn, $user, $pass, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);
    },
    UserRepositoryInterface::class => autowire(UserPDORepository::class),
    RefreshTokenRepositoryInterface::class => autowire(RefreshTokenPDORepository::class),
    ServiceRepositoryInterface::class => autowire(ServicePDORepository::class),
]);

return $builder->build();