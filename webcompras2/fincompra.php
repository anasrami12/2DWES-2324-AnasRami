<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php
    session_start();
if (!isset($_SESSION['usuario'])) {
        header( 'Location: nologin.html');
      }
var_dump($_SESSION);
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Productos</th>";
    echo "<th>Cantidad</th>";
    echo "</tr>";
    for ($i = 0; $i < max(count($_SESSION['productos']), count($_SESSION['cantidades'])); $i++) {
        echo "<tr>";
        echo "<td>";
            echo $_SESSION['productos'][$i];
        echo "</td>";
        echo "<td>";
            echo $_SESSION['cantidades'][$i];
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";



?>
<br>
<input type="submit" name="enviar" value="Confirmar compra">
</form>
<?php
if (isset($_POST['enviar'])) {
    foreach ($_SESSION['cantidades'] as $key => $cant) {
        $id = $_SESSION['carrito'][$key];
        echo $id;
      cantidad();
    }
    }
    function cantidad(){
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "comprasweb";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "UPDATE ALMACENA SET CANTIDAD= :cant WHERE id_producto= :id";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':cant', $cant);
        $stmt->bindParam(':id', $id);
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
</html>
