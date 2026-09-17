<?php

require __DIR__ . '/data/productos.php'; 

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($path, '/');

if ($path === '' || $path === '/entidad') {

    require __DIR__ . '/views/listado.php';

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

} elseif ($path === '/create/entidad') {
    echo "<h1>Creando Entidad</h1>";

} else {
    http_response_code(404);
    echo "<h1>404 - No encontrado</h1>";
}
