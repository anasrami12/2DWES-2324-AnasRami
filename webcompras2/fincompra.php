<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check</title>
    <style>
         body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(45deg, #3498db, #8e44ad, #3498db, #8e44ad);
            background-size: 400% 400%;
            animation: gradientAnimation 15s infinite;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            position: relative;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            position: relative;
            z-index: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background: #c0392b;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header( 'Location: nologin.html');
      }
    

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
    if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['cantidades'] as $key => $cant) {
        $id = $_SESSION['carrito'][$key];
        cantidad($id, $cant); 
    }
    unset($_SESSION['carrito']);
    unset($_SESSION['productos']);
    unset($_SESSION['cantidades']);
    header('Location: sesionini.php');
}
}

function cantidad($id, $cant){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Utilizar la cantidad actual menos la nueva cantidad
        $sql = "UPDATE almacena SET cantidad = cantidad - :cant WHERE id_producto = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':cant', $cant);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

       
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>



</html>