<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Controllers\AuthController;
use App\Middleware\AuthMiddleware;
use App\Middleware\LogMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware(); // para poder leer $request->getParsedBody() en POST
$app->addErrorMiddleware(true, true, true);

$app->add(new LogMiddleware());

$app->get('/auth/register', [AuthController::class, 'showRegister']);
$app->post('/auth/register', [AuthController::class, 'register']);
$app->get('/auth/login', [AuthController::class, 'showLogin']);
$app->post('/auth/login', [AuthController::class, 'login']);
$app->post('/auth/logout', [AuthController::class, 'logout']);

$app->get('/', function (Request $request, Response $response) {
    $nombre = $_SESSION['user_name'] ?? null;
    $html = $nombre
        ? "<h1>Hola, {$nombre}!</h1><p><a href='/entidad'>Ir al listado</a></p><form action='/auth/logout' method='POST'><button>Cerrar sesión</button></form>"
        : "<h1>Bienvenido</h1><p><a href='/auth/login'>Iniciar sesión</a> | <a href='/auth/register'>Registrarme</a></p>";
    $response->getBody()->write($html);
    return $response;
});

$app->group('', function ($group) {

    $group->get('/entidad', function (Request $request, Response $response) {
        $response->getBody()->write('<h1>Listado de Entidad</h1><p>(ruta protegida, solo si estás logueado)</p>');
        return $response;
    });

    $group->get('/entidad/{id}', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("<h1>Detalle de la Entidad {$args['id']}</h1>");
        return $response;
    });

    $group->get('/create/entidad', function (Request $request, Response $response) {
        $response->getBody()->write('<h1>Creando Entidad</h1>');
        return $response;
    });

})->add(new AuthMiddleware());

$app->run();
