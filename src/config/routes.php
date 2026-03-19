<?

namespace App\Config;

use Composer\Autoload\ClassLoader;
use Exception;
use DI\Container;

class Routes {

    private static function loadContainer($action, $method, Container $container, $params = null)
    {
        if(!class_exists($action)) {
            return throw new Exception("Error Processing Request: Class not found");
        }

        $action = $container->get($action);

        if(!is_callable([$action,$method])) {
            return throw new Exception("Error Processing Request: Method not found");
        }

        return call_user_func([$action, $method],$params);
    }

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
            $params = explode('/', trim($currentUri,'/'));
            
            if(isset($params[1])) {
                return $callback($params[1]);
            } else {
                return $callback();
            }
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


    public static function router(Container $container)
    {
        try {
            self::get('/auth/refresh-token/{id}', function() use($container) {

            });

            self::post('/auth/login', function() use($container) {

            });

            self::get('/user/{id}', function ($id) use($container) {
                $showUserAction = \App\Application\Actions\User\ShowUserAction::class;
                $result = self::loadContainer($showUserAction, 'show', $container, $id);
                echo json_encode(['data' => $result]);
            });

            self::post('/user/create', function () use($container) {
                $createUserAction = \App\Application\Actions\User\CreateUserAction::class;
                $result = self::loadContainer($createUserAction, 'create', $container);
                echo json_encode(['data' => $result]);
            });

            self::delete('/user/{id}/delete', function ($id) use($container) {
                $deleteUserAction =  \App\Application\Actions\User\DeleteUserAction::class;
                $result = self::loadContainer($deleteUserAction, 'delete', $container, $id);
                echo json_encode(['data' => $result]);
            });

            self::put('/user/{id}/update', function ($id) use($container) {
                $updateUserAction = \App\Application\Actions\User\UpdateUserAction::class;
                $result = self::loadContainer($updateUserAction, 'update', $container, $id);
                echo json_encode(['data' => $result]);
            });
        } catch (\Exception $e) {
            http_response_code(404);
            throw new Exception("Error Processing Request: ".$e, 1);
            
            echo json_encode(['error'=> 'Rota não encontrada']);
        }

    }
}