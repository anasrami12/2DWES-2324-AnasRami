
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h2>Consulta por fecha</h2>

    <form method="post">
        <label for="empleados">Fecha:</label>
    <input type="date" name='fecha'>
    <br>
<label for="enviar"></label>
<input type="submit" name='enviar'>
<?php
include 'funciones.php';
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "webemple";
if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
    buscarfecha($servername,$dbname,$username,$password);
   
    
}
?>

</body>
</html>