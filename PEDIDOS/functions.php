<?php
function datadb(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "pedidos";

    return array(
        'servername' => $servername,
        'username' => $username,
        'password' => $password,
        'dbname' => $dbname
    );
}

function login($user,$pass){
    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT contactFirstName from customers where CustomerNumber= :usuario AND ContactLastName =:contra;");
        $stmt -> bindParam(':usuario', $user);
        $stmt -> bindParam(':contra', $pass);
       
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($info)) {
            $name=$info[0]['contactFirstName'];
          session_start();
          $_SESSION['customernum']=$user;
          $_SESSION['name']=$name;
          header('Location: pe_inicio.php');
          exit;
      } else {
          echo "Usuario o contraseña incorrectos";
      }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
function checklog(){
    session_start();
    if (!isset($_SESSION['name'])) {
        header('Location: nologin.html');
        exit;
     }else{
         echo "<h4>Welcome " . $_SESSION['name']. "</h4>";
         echo "<br>";
     }
}
function showproducts(){
    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT productCode, productName FROM products WHERE quantityInStock > 0 ";

$consulta = $conn->prepare($sql);
$consulta->execute();

$filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($filas as $fila) {
echo "<option value='{$fila['productCode']}'>{$fila['productName']}</option>";
}
$conn=NULL;
}
function logoff(){
session_unset();
session_destroy();
$cookies = $_COOKIE;
foreach ($cookies as $cookie_name => $cookie_value) {
    setcookie($cookie_name, '', time() - 3600, '/');
}
header('Location: nologin.html');
exit;
}

function dates(){
    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $customernum = $_SESSION['customernum'];
        $stmt = $conn->prepare("INSERT INTO orders (customerNumber, orderNumber, orderDate, requiredDate, shippedDate, status)
            SELECT 
                :customernum,
                COALESCE(MAX(orderNumber), 0) + 1,
                NOW(),  
                NOW(),  
                NULL,   
                'Pending'  
            FROM orders;
        ");
        $stmt->bindParam(':customernum', $customernum);
        $stmt->execute();
        echo "Nuevo pedido realizado"; 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
        $conn = null;
    
    
}

function regexNumber($cadena){
    $regex = '/^[A-Za-z]{2}\d{5}$/';
    if (!preg_match($regex, $cadena)) {
        echo "<script> alert('Invalid CheckNumber'); </script>";
    } else {
        dates();
        foreach ($_SESSION['carrito'] as $clave => $infoProducto) {     
            decreaseStock($infoProducto['product'],$infoProducto['quantity']);
                }
    }
}

function addcarrito() {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $product = $_POST['selprod'];
    $quantity = $_POST['cantidad'];

    // Verificar si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$product])) {
        // Si el producto ya está en el carrito, sumar la cantidad existente
        $_SESSION['carrito'][$product]['quantity'] += $quantity;
    } else {
        // Si el producto no está en el carrito, agregarlo con la cantidad proporcionada
        $productinfo = array(
            'product' => $product,
            'quantity' => $quantity
        );
        $_SESSION['carrito'][$product] = $productinfo;
    }

    var_dump($_SESSION['carrito']);
    echo "Producto añadido satisfactoriamente";
}


function stockCheck($code,$quantity){
    if ($quantity==''|| $quantity==0) {
        echo "Introduzca una cantidad";
    }else {
        $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT quantityInStock from products where productCode= :code;");
        $stmt -> bindParam(':code', $code);
        $stmt->execute(); 
        $cantidad = $stmt->fetchColumn();
       
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    if (intval($cantidad) < intval($quantity)) {
        echo "Insuficiente Stock";
    } else {
        addcarrito();
    }
    $conn = null;
  
    }
    
}

function readypay(){
    if (isset($_SESSION['carrito'])) {
        echo "CheckNumber: ";
        echo "<form method='post'>";
        echo "<input type='text' name='checknum'>";
        echo "<br>";
        echo "<input type='submit' name='confirm' value='Confirm'>";
        echo "</form>";
        exit;
    
       }else  {
        echo "Añada productos al carrito";
       }

}


function amount($product,$cantidad){
    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT buyPrice from products where productCode=:product;");
        $stmt -> bindParam(':product', $product);
        $stmt->execute(); 
        $precio = $stmt->fetchColumn();
        $total=$precio*$cantidad;
        if (!isset($_SESSION['amount'])) {
            $_SESSION['amount']=array();
        }
        array_push($_SESSION['amount'],$total);
      
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}

function disBoton(){
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '  document.getElementById("compra").disabled = true;'; 
    echo '});';
    echo '</script>';
}

function decreaseStock($product,$amount){
    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE products SET quantityInStock = quantityInStock - :amount WHERE productCode = :productCode;");
        $stmt -> bindParam(':productCode', $product);
        $stmt -> bindParam(':amount', $amount);
        $stmt->execute(); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
  }

  function showorders(){

    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select orderNumber,orderDate,status from orders where customerNumber= :customernum;");
        $stmt -> bindParam(':customernum', $_SESSION['customernum']);
        $stmt->execute(); 
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
       if (!empty($pedidos)) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>OrderNum</td>";
        echo "<td>OrderDate</td>";
        echo "<td>Status</td>";
        echo "</tr>";
        foreach ($pedidos as $a) {
            echo "<tr>";
            echo "<td>".$a['orderNumber']."</td>";
            echo "<td>".$a['orderDate']."</td>";
            echo "<td>".$a['status']."</td>";
            echo "</tr>";
        }
        echo "</table>";
       }
        
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}

function showstock(){
    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT quantityInStock FROM products WHERE productCode=:productcode";
$consulta = $conn->prepare($sql);
$consulta->bindParam(':productcode', $_POST['producto']);

$consulta->execute();

$stock = $consulta->fetchColumn();
echo "Stock: ";

echo "<input type='text' readonly value='$stock'>";

}

function showcategory(){
    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT distinct productLine from products;");
        $stmt->execute(); 
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categorias as $key) {
            echo "<option value='{$key['productLine']}'>{$key['productLine']}</option>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>