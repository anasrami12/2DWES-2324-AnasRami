<!DOCTYPE html>
<html>
<head>
    <title>Buscar Archivo</title>
</head>
<body>
    <h2>Buscar Archivo</h2>
    <form method="post">
        <label for="archivo">Selecciona un archivo:</label><br>
        <input type="text" name="archivo" placeholder="Path/Nombre">
        <br>
        Operaciones:<br>
        <input type="radio" name="opcion" id="mostrartodo" value="mostrartodo">Mostrar Fichero<br>
        <input type="radio" name="opcion" id="lineax" value="lineax">Mostrar linea <input type="number" name="linea"> del fichero<br>
        <input type="radio" name="opcion" id="xlineas" value="xlineas">Mostrar <input type="number" name="numlineas"> primeras lineas del fichero<br>
        <input type="submit" name="enviar" value="Buscar en Archivo">
        <input type="reset" value="Borrar"><br>
        El resultado aparecera aqui:<br>
    </form>
    <?php
    if (isset($_POST['enviar'])) {
        $archivo = $_POST['archivo'];
        $opcion = $_POST['opcion'];
        $numlinea=$_POST['linea'];
        $filas=$_POST['numlineas'];


        if ($opcion == 'mostrartodo') {
            fopen($archivo,'r');
            $lineas=file($archivo);
            for ($i=0; $i < count($lineas); $i++) { 
                echo $lineas[$i];
                echo'<br>';
            }
        }
        if ($opcion == 'lineax') {
            fopen($archivo,'r');
            $lineas=file($archivo);
            echo $lineas[$numlinea-1];
        }
        if ($opcion == 'xlineas') {
            fopen($archivo,'r');
            $lineas=file($archivo);
            for ($i=0; $i < $filas; $i++) { 
                echo $lineas[$i];
                echo'<br>';
            }
        }
        
    }
    ?>
</body>
</html>
