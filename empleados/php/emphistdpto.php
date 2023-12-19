<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h2>Cambio Departamento</h2>

    <form method="post">
<?php
include 'funciones.php';
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "webemple";
mostrardpto($servername,$username,$password,$dbname);
if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
//consulta sql: select distinct nombre,apellidos from empleado, emple_depart where empleado.dni in (select dni from emple_depart where cod_dpto='D001') and fecha_fin is NULL ;

        histemple($servername,$username,$password,$dbname);
}


?>
<br>
 <button type="submit">Enviar</button>
    </form>
</body>
</html>
