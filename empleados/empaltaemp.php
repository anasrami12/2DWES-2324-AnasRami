<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h2>Insertar empleado</h2>

    <form method="post">
        <label for="nombreCategoria">Nombre del empleado:</label>
        <input type="text" id="emp" name="nombre" required>
<br>
        <label for="nombreCategoria">Apellido del empleado:</label>
        <input type="text" id="emp" name="apellido" required>
        <br>
        <label for="nombreCategoria">Salario del empleado:</label>
        <input type="text" id="emp" name="salario" required>
        <br>
        <label for="nombreCategoria">Fecha nacimiento del empleado:</label>
        <input type="date" id="emp" name="nacimiento" required>
        <br>
        <label for="nombreCategoria">DNI/NIE del empleado:</label>
        <input type="text" id="emp" name="dni" required>
<br>
    <label for="nombreCategoria">Fecha inicio del empleado:</label>
        <input type="date" id="emp" name="inicio" required>
        <br>
       
<?php
include 'funciones.php';
$servidor = "localhost";
$usuario = "root";
$contra = "rootroot";
$basedatos = "webemple";
mostrardpto($servidor,$usuario,$contra,$basedatos);
if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
        insertaremple($servidor,$usuario,$contra,$basedatos);
    } 
?>
<br>
 <button type="submit">Enviar</button>
    </form>
</body>
</html>