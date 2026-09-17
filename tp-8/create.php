<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Creando Entidad</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 40px; }
        h1 { color: #222; }
        form {
            background: #fff; padding: 24px; border-radius: 8px; max-width: 400px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        label { display: block; margin-top: 14px; margin-bottom: 4px; font-weight: bold; color: #333; }
        input, textarea {
            width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;
            font-size: 14px; box-sizing: border-box;
        }
        button {
            margin-top: 20px; padding: 10px 18px; background: #1a73e8; color: #fff;
            border: none; border-radius: 4px; cursor: pointer; font-size: 14px;
        }
        button:hover { background: #1558b0; }
    </style>
</head>
<body>
    <h1>Creando Entidad</h1>

    <form action="/entidad" method="POST">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Precio</label>
        <input type="number" id="price" name="price" min="0" step="1" required>

        <label for="description">Descripción</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <button type="submit">Crear</button>
    </form>
</body>
</html>
