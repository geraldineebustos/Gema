?php

use App\Middleware\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->group('', function ($group) {

    $group->get('/entidad', function (Request $request, Response $response) {
        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : null;

        $productos = [
            ['id' => 1, 'name' => 'Camiseta de futbol', 'price' => 15000],
            ['id' => 2, 'name' => 'Botines',            'price' => 45000],
            ['id' => 3, 'name' => 'Pelota',             'price' => 2000],
        ];

        if ($limit !== null && $limit > 0) {
            $productos = array_slice($productos, 0, $limit);
        }

        $html = '<h1>Listado de Entidad</h1><ul>';
        foreach ($productos as $p) {
            $html .= "<li>{$p['name']} - \${$p['price']}</li>";
        }
        $html .= '</ul>';

        $response->getBody()->write($html);
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

    $group->post('/entidad', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $response->getBody()->write(
            "<h1>Entidad creada</h1><p>{$data['name']} - \${$data['price']} - {$data['description']}</p>"
        );
        return $response;
    });

})->add(new AuthMiddleware());
