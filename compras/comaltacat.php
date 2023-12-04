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
        <label for="nombreCategoria">Nombre de la Categoría:</label>
        <input type="text" id="nombreCategoria" name="nombre" required>
<br>
        <label for="idCategoria">ID de la Categoría:</label>
        <input type="text" id="idCategoria" name="idcategoria" required>
<br>
        <button type="submit">Enviar</button>
    </form>
<?php

if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
   $limpiar= $_POST['idcategoria'];
    $expresionRegular = "/^C-0*([1-9][0-9]*)$/";

    // Realizar la coincidencia
    if (preg_match($expresionRegular, $limpiar, $matches)) {
        $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO categoria (id_categoria,nombre) VALUES (:id_categoria,:nombre)");
        $stmt->bindParam(':id_categoria', $id);
        $stmt->bindParam(':nombre', $nombre);
      
        // insert a row
        $id = $_POST['idcategoria'];
        $nombre = $_POST['nombre'];
        $stmt->execute();
    
        echo "New records created successfully";
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
    } else {
        echo "La cadena no cumple con el formato.";
    }

    }

?>
</body>
</html>
