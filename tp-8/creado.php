<php> 

</php>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entidad creada</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 40px; }
        h1 { color: #222; }
        .card {
            background: #fff; border-radius: 8px; padding: 20px; max-width: 400px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .card p { margin: 6px 0; color: #333; }
        .card strong { color: #555; }
        a { display: inline-block; margin-top: 16px; color: #1a73e8; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Entidad creada correctamente</h1>

    <div class="card">
        <p><strong>Nombre:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>Precio:</strong> $<?= number_format((float) $price, 0, ',', '.') ?></p>
        <p><strong>Descripción:</strong> <?= htmlspecialchars($description ?: 'Sin descripción') ?></p>
    </div>

    <a href="/entidad">Volver al listado</a>
</body>
</html>
