<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h2>Insertar departamento</h2>

    <form method="post">
        <label for="nombreCategoria">Nombre de departamento:</label>
        <input type="text" id="dpt" name="nombre" required>
<br>
        <button type="submit">Enviar</button>
    </form>
<?php
include 'funciones.php';
if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
        $servidor = "localhost";
    $usuario = "root";
    $contra = "rootroot";
    $basedatos = "webemple";
    adddpto($servidor,$usuario,$contra,$basedatos);
    } 
?>
</body>
</html>
