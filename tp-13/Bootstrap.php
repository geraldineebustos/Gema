<?php

require __DIR__ . '/vendor/autoload.php';

session_start();

use App\Middleware\LogMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);


$app->add(new LogMiddleware());


$app->get('/', function (Request $request, Response $response) {
    $nombre = $_SESSION['user_name'] ?? null;
    $html = $nombre
        ? "<h1>Hola, {$nombre}!</h1><p><a href='/entidad'>Ir al listado</a></p>"
        : "<h1>Bienvenido</h1><p><a href='/auth/login'>Iniciar sesión</a> | <a href='/auth/register'>Registrarme</a></p>";
    $response->getBody()->write($html);
    return $response;
});


require __DIR__ . '/routes/auth.routes.php';
require __DIR__ . '/routes/productos.routes.php';

return $app;
