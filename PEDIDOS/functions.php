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
        $stmt = $conn->prepare("INSERT INTO orders (orderDate, requiredDate, shippedDate) VALUES (:orderdate,:requireddate,NULL);");
        $stmt -> bindParam(':orderdate', $orderdate);
        $stmt -> bindParam(':requireddate', $requireddate);
        $orderdate=date("Y-m-d");
        $requireddate=date("Y-m-d");
        $stmt->execute(); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    
    
}

function regexNumber(){
    $regex = '/^[A-Za-z]{2}\d{5}$/';
    if (!preg_match($regex, $cadena)) {
        throw new Exception("Invalid CheckNumber");
    } else {
        dates();
    }
}

function addcarrito(){
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $product = $_POST['selprod'];
    $quantity = $_POST['cantidad'];
    $productinfo = array(
        'product' => $product,
        'quantity' => $quantity
    );
    $_SESSION['carrito'][$product] = $productinfo;
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

?>