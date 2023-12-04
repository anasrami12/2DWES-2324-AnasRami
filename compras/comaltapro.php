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
        <label for="nombreCategoria">Nombre del producto:</label>
        <input type="text" id="nombreCategoria" name="nombre" required>
<br>
        <label for="idCategoria">ID del producto:</label>
        <input type="text" id="idCategoria" name="idproducto" required>
<br>  
        <label for="nombreCategoria">Precio:</label>
        <input type="number" id="nombreCategoria" name="precio" required>
<br>
        <label for="idCategoria">ID de la Categoría:</label>
        <input type="text" id="idCategoria" name="idcategoria" required>
<br>
        <button type="submit">Enviar</button>
    </form>
<?php

if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
   $limpiar= $_POST['idproducto'];
    $expresionRegular = '/^P0*([1-9][0-9]*)$/';

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
        $stmt = $conn->prepare("INSERT INTO producto (id_producto,nombre,precio,id_categoria) VALUES (:id_producto,:nombre,:precio,:id_categoria)");
        $stmt->bindParam(':id_producto', $idprod);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_categoria', $idcat);
        
      
        // insert a row
        $idcat = $_POST['idcategoria'];
        $nombre = $_POST['nombre'];
        $idprod = $_POST['idproducto'];
        $precio = $_POST['precio'];
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
