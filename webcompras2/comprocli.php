<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header( 'Location: nologin.html');
}else {

  echo "<h2>Usuario: ". $_SESSION['usuario'] ."</h2>";
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
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
    }
    input, button {
      margin-bottom: 16px;
    }
  </style>
  </head>
<body>
<h2>Compra de productos</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <p>Productos:</p>
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