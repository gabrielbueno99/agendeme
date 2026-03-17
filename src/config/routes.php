<?

namespace App\Config;

use Exception;

class Routes {
    private static function handle($method, $uri, $callback)
    {
        $currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $currentMethod = $_SERVER['REQUEST_METHOD'];

        if($currentMethod !== $method) {
            return new Exception("Method not found");
        }

        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";
        

        if(preg_match($pattern, $currentUri,$matches)) {
            $callback();
        }
    }

    private static function get($uri, $callback)
    {
        self::handle('GET',$uri,$callback);
    }

    private static function post($uri, $callback)
    {
        self::handle('POST',$uri,$callback);
    }

    private static function delete($uri, $callback)
    {
        self::handle('DELETE',$uri,$callback);
    }

    private static function put($uri, $callback)
    {
        self::handle('PUT',$uri,$callback);
    }


    public static function router($container)
    {
        try {
            self::get('/auth/refresh-token/{id}', function() {

            });

            self::post('/auth/login', function() {

            });

            self::get('/user/{id}', function () {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'bem vindo get']);
            });

            self::post('/user/create', function () {
                header('Content-Type: application/json');
                // echo json_encode(['message' => 'bem vindo post']);
            });

            self::delete('/user/delete/{id}', function () {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'bem vindo post']);
            });

            self::put('/user/update/{id}', function () {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'bem vindo post']);
            });
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(['error'=> 'Rota não encontrada']);
        }

    }
}