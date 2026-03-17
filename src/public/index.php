<?php
require '../vendor/autoload.php';
use DI\Container;

header('Content-Type: application/json');

try {
    $container = require_once '../config/Container.php';
    //testa conexão com banco
    $container->get(PDO::class);

    App\Config\Routes::router($container);

} catch (\PDOException $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode([
        'error' => 'Banco de dados inacessível',
        'message' => 'O container MySQL ainda está iniciando ou as credenciais no .env estão incorretas.'
    ]);
    exit;

} catch (\Exception $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode([
        'error' => 'Erro interno do servidor',
        'message' => $e->getMessage()
    ]);
    exit;
}