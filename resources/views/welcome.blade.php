<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Mercado bodegas</title>
    </head>
    <body>
        <h1>Mercado Bodegas</h1>
        <form method="get" action="http://localhost:8000/api/ruta/">
            <p>
                <label for="ubicacion_label">ingresa direccion, calle, comuna o ciudad</label>
                <input type="text" name="ubicacion"/>
            </p>
            <input type="submit" value="BUSCAR"/>
        </form>
    </body>
</html>