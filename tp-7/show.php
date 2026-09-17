<?php
$id = $id ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de la Entidad</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 40px; }
        h1 { color: #222; }
        a { color: #1a73e8; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Detalle de la Entidad <?= htmlspecialchars((string) $id) ?></h1>
    <p><a href="/entidad">Volver al listado</a></p>
</body>
</html>
