<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Categoría</title>
</head>
<body>
    Stock:
    <select name="stock">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "comprasweb";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM producto";

            $consulta = $conn->prepare($sql);
            $consulta->execute();

            
            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$fila['id_producto']}'>{$fila['nombre']}</option>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
        ?>
    </select>
</body>
</html>
