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
mostrardpto($servername,$username,$password,$dbname);
?>
<br>
<label for="fechacambio">Fecha del cambio:</label>
<input type='date' name='fechacambio'>
<?php
if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
    cambiodpto($servername,$dbname,$username,$password);
}
?>
<br>
 <button type="submit">Enviar</button>
    </form>
</body>
</html>