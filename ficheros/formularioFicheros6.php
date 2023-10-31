<!DOCTYPE html>
<html>
<head>
    <title>Buscar Archivo</title>
</head>
<body>
    <h2>Buscar Archivo</h2>
    <form method="post">
        <label for="archivo">Nombre del fichero con extension:</label><br>
        <input type="text" name="archivo" placeholder="Path/Nombre">
        <br>
        <input type="submit" name="enviar" value="Ver Datos">
        <input type="reset" value="Borrar"><br>
    </form>
    <?php
    if (isset($_POST['enviar'])) {
        $archivo = $_POST['archivo'];
        echo '<h1>OPERACIONES FICHEROS </h1>';
        echo 'Nombre: '.basename($archivo);
        echo '<br>';
        echo 'Directorio'. realpath($archivo);
        echo '<br>';
        echo "Ultima modificacion: ".date(" d/M/ Y/ H:i:s.", filectime($archivo));
        echo '<br>';
        echo "Tamaño: ".filesize($archivo)." Bytes";

        
    }
    ?>
</body>
</html>