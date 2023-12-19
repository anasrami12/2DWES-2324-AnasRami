<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h2>Cambio Departamento</h2>

    <form method="post">
        <label for="empleados">Nombre del empleado:</label>
        <select name='empleados'>
<?php
include 'funciones.php';
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "webemple";
selectEmpleado($servername,$dbname,$username,$password);
?>
<br>
<label for='salario'>% de cambio: </label>
<input type="number" name='salario' placeholder='Ej:50%'>
<?php
if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
    modsalario($servername,$dbname,$username,$password);
}
?>
<br>
<label for="enviar"></label>
<input type="submit" name='enviar'>
</body>
</html>