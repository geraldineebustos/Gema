<?php

require __DIR__ . '/data/productos.php'; 
$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path   = rtrim($path, '/');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && ($path === '' || $path === '/entidad')) {

    require __DIR__ . '/views/listado.php';

} elseif ($method === 'POST' && $path === '/entidad') {
 

    $name        = trim($_POST['name'] ?? '');
    $price       = trim($_POST['price'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($name === '' || $price === '' || !is_numeric($price)) {
        http_response_code(400);
        echo "<h1>Datos inválidos</h1><p>Nombre y precio (numérico) son obligatorios.</p>";
        echo '<a href="/create/entidad">Volver al formulario</a>';
        exit;
    }

    require __DIR__ . '/views/creado.php';

} elseif ($method === 'GET' && $path === '/create/entidad') {

    require __DIR__ . '/views/create.php';

} elseif (preg_match('#^/entidad/(\d+)$#', $path, $matches)) {

    $id = (int) $matches[1];
    $entidad = null;
    foreach ($productos as $p) {
        if ($p['id'] === $id) {
            $entidad = $p;
            break;
        }
    }
    echo "<h1>Detalle de la Entidad {$id}</h1>";
    if ($entidad) {
        echo "<p>{$entidad['name']} - $" . number_format($entidad['price'], 0, ',', '.') . "</p>";
    } else {
        echo "<p>No se encontró la entidad.</p>";
    }

} else {
    http_response_code(404);
    echo "<h1>404 - No encontrado</h1>";
}
