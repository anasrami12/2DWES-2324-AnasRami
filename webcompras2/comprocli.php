<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header( 'Location: nologin.html');
}else {

  echo "<h2 class='user'>Usuario: ". $_SESSION['usuario'] ."</h2>";
  $servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "comprasweb";
}
if (!isset($_SESSION['carrito'])&&!isset($_SESSION['cantidades'])&&!isset($_SESSION['productos'])) {
  $_SESSION['carrito']= array();
  $_SESSION['cantidades']=array();
  $_SESSION['productos']=array();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alta Categoria</title>
  <style>
    .user{
    
      position: fixed;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      margin: 0;
      padding: 20px;
      background-color: green;
      color: #fff;
      width: 100%;
      text-align: center;
      z-index: 1000; /* Asegura que el h2 esté en la parte superior */
    
    }
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
    }

    form {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    h2 {
      color: green;
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #333;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      padding: 10px 20px;
      font-size: 1.2em;
      cursor: pointer;
      background: #2ecc71;
      background-image: linear-gradient(45deg, #2ecc71, #27ae60);
      color: #fff;
      border: none;
      border-radius: 4px;
      transition: background 0.3s;
    }

    button:hover {
      background: #27ae60;
      background-image: linear-gradient(45deg, #27ae60, #2ecc71);
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
  <h2>Productos:</h2>
  <select name="producto">
    <?php
 try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT nombre FROM producto";

  $consulta = $conn->prepare($sql);
  $consulta->execute();

  $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);

  foreach ($filas as $fila) {
      echo "<option value='{$fila['nombre']}'>{$fila['nombre']}</option>";
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn=null;
?>
</select>
<br>
Cantidad:
<br>
<input type="number" name="cantidadcliente">
<br>
<br>
<input type="submit" name="carro" value="Añadir al carrito">
<input type="submit" name="compra" value="Finalizar compra">
<br>
<?php
if (isset($_POST['carro'])) {
  $cantidadcliente=$_POST['cantidadcliente'];
  $producto=$_POST['producto'];
  if (!is_numeric($cantidadcliente)||$cantidadcliente<=0){
    echo "Seleccione minimo 1 producto";
  }else {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $sql = "SELECT id_producto FROM producto where nombre= :nombreprod";
      $consulta = $conn->prepare($sql);
      $consulta->bindParam(':nombreprod', $producto);
      $consulta->execute();
    
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $idprod = $consulta->fetchColumn();
    $conn=null;
  
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $sql = "SELECT cantidad FROM almacena where id_producto= :idproducto";
      $consulta = $conn->prepare($sql);
      $consulta->bindParam(':idproducto', $idprod);
      $consulta->execute();
    
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $cantidad = $consulta->fetchColumn();
    $conn=null;
  /////////////////////////////
  if ($cantidad<$cantidadcliente) {
      echo "No hay suficiente stock";
  }else{
    array_push($_SESSION['carrito'],$idprod);
    array_push($_SESSION['cantidades'],$cantidadcliente);
    array_push($_SESSION['productos'],$producto);
     var_dump($_SESSION['carrito']);
     var_dump($_SESSION['cantidades']);
     var_dump($_SESSION['productos']);
  }
  
  }
}
if (isset($_POST['compra'])) {
  if (count($_SESSION['carrito'])<=0) {
    echo "Ningun producto añadido";
  }else {
    header('Location: fincompra.php ');
  }
    
}
?>
  </form>

  
</body>
</html>