<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Categoría</title>
</head>
<body>

    <h2>Insertar categoria</h2>

    <form method="post">
        <label for="nombreCategoria">Localidad del almacen:</label>
        <input type="text" id="nombreCategoria" name="localidad" required>
<br>
        <label for="idCategoria">Numero de almacen:</label>
        <input type="text" id="idCategoria" name="numalmacen" required>
<br>  
        <button type="submit">Enviar</button>
    </form>
<?php

if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
        $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO almacen (num_almacen,localidad) VALUES (:num_almacen,:localidad)");
        $stmt->bindParam(':num_almacen', $almacen);
        $stmt->bindParam(':localidad', $localidad);
        
      
        // insert a row
        $almacen = $_POST['numalmacen'];
        $localidad = $_POST['localidad'];
        $stmt->execute();
    
        echo "New records created successfully";
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
    }

    

?>
</body>
</html>