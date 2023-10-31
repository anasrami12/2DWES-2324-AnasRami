<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label for="apellido1">Primer Apellido:</label>
        <input type="text" name="apellido1" required><br><br>

        <label for="apellido2">Segundo Apellido:</label>
        <input type="text" name="apellido2" required><br><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" required><br><br>

        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad" required><br><br>

        <input type="submit" value="Guardar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $fecha = $_POST['fecha_nacimiento'];
        $localidad = $_POST['localidad'];

        $archivo= fopen('datos1.txt','a');
        $nombre=str_pad($nombre,40," ",STR_PAD_RIGHT);
        $apellido1=str_pad($apellido1,40," ",STR_PAD_RIGHT);
        $apellido2=str_pad($apellido2,42," ",STR_PAD_RIGHT);
        $fecha=str_pad($fecha,9," ",STR_PAD_RIGHT);
        $localidad=str_pad($localidad,36," ",STR_PAD_RIGHT);
        fwrite($archivo,$nombre);
        fwrite($archivo,$apellido1);
        fwrite($archivo,$apellido2);
        fwrite($archivo,$fecha);
        fwrite($archivo,$localidad);
        fwrite($archivo,"\n");

        
    }
    ?>
</body>
</html>
