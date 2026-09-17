<?php

$productos = $productos ?? [
    ['id' => 1, 'name' => 'Camiseta de futbol', 'price' => 15000],
    ['id' => 2, 'name' => 'Botines',            'price' => 45000],
    ['id' => 3, 'name' => 'Pelota',             'price' => 2000],
];

if (!empty($limit) && $limit > 0) {
    $productos = array_slice($productos, 0, $limit);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Entidad</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 40px; }
        h1 { color: #222; }
        .grid { display: flex; flex-wrap: wrap; gap: 16px; }
        .card {
            background: #fff; border-radius: 8px; padding: 16px; width: 220px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .card h3 { margin: 0 0 8px; }
        .card p { margin: 0; color: #555; }
        .card a { display: inline-block; margin-top: 10px; color: #1a73e8; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Listado de Entidad</h1>

    <div class="grid">
        <?php foreach ($productos as $p): ?>
            <div class="card">
                <h3><?= htmlspecialchars($p['name']) ?></h3>
                <p>$<?= number_format($p['price'], 0, ',', '.') ?></p>
                <a href="/entidad/<?= $p['id'] ?>">Ver detalle</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
