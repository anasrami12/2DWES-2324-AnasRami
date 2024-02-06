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
function dbinfo(){
    $database_info = datadb();
    return $database_info;
}

function conn(){
    $database_info = dbinfo();

    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        return null;
    }
}

function login($user, $pass){
    $conn = conn();

    try {
        $stmt = $conn->prepare("SELECT contactFirstName from customers where CustomerNumber= :usuario AND ContactLastName =:contra;");
        $stmt->bindParam(':usuario', $user);
        $stmt->bindParam(':contra', $pass);

        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($info)) {
            $name = $info[0]['contactFirstName'];
            session_start();
            $_SESSION['customernum'] = $user;
            $_SESSION['name'] = $name;
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
function pintarproductos($filas){
    foreach ($filas as $fila) {
        echo "<option value='{$fila['productCode']}'>{$fila['productName']}</option>";
    }
}
function showproducts(){
    $conn = conn(); 
    try {
        $sql = "SELECT productCode, productName FROM products WHERE quantityInStock > 0 ";

        $consulta = $conn->prepare($sql);
        $consulta->execute();

        $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);

        pintarproductos($filas);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
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

function generateOrderNumber($conn, $customernum) {
    $stmt = $conn->prepare("SELECT COALESCE(MAX(orderNumber), 0) + 1 AS newOrderNumber FROM orders;");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['orderNum'] =$result['newOrderNumber']+2;
    return $result['newOrderNumber'];
}
function dates() {
    try {
        $conn = conn();
        $conn->beginTransaction();

        $customernum = $_SESSION['customernum'];
        $newOrderNumber = generateOrderNumber($conn, $customernum);

        $stmt = $conn->prepare("INSERT INTO orders (customerNumber, orderNumber, orderDate, requiredDate, shippedDate, status)
            VALUES (:customernum, :newOrderNumber, NOW(), NOW(), NULL, 'Pending')");
        $stmt->bindParam(':customernum', $customernum);
        $stmt->bindParam(':newOrderNumber', $newOrderNumber);
        $stmt->execute();
        $conn->commit();

        echo "Nuevo pedido realizado"; 
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
        
            $conn = null;
        
    }
}


function regexNumber($cadena) {
    $regex = '/^[A-Za-z]{2}\d{5}$/';
    if (!preg_match($regex, $cadena)) {
        echo "<script> alert('Invalid CheckNumber'); </script>";
    } else {
        try {
            $conn = conn();
            $customernum = $_SESSION['customernum'];
            generateOrderNumber($conn, $customernum);
            pago();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
                $conn = null;
        }
    }
}

function addcarrito() {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $product = $_POST['selprod'];
    $quantity = $_POST['cantidad'];

    if (isset($_SESSION['carrito'][$product])) {
        $_SESSION['carrito'][$product]['quantity'] += $quantity;
    } else {
        $productinfo = array(
            'product' => $product,
            'quantity' => $quantity
        );
        $_SESSION['carrito'][$product] = $productinfo;
    }

    var_dump($_SESSION['carrito']);
    echo "Producto añadido satisfactoriamente";
}


function stockCheck($code, $quantity){
    if ($quantity == '' || $quantity == 0) {
        echo "Introduzca una cantidad";
    } else {
        try {
            $conn = conn();
            $stmt = $conn->prepare("SELECT quantityInStock FROM products WHERE productCode = :code;");
            $stmt->bindParam(':code', $code);
            $stmt->execute();
            $availableStock = $stmt->fetchColumn();
            if (intval($availableStock) < intval($quantity)) {
                echo "Insuficiente Stock";
            } else {
                addcarrito();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
                $conn = null;
        }
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


function amount($product, $cantidad){
    $conn = conn();
    try {
        $stmt = $conn->prepare("SELECT buyPrice FROM products WHERE productCode = :product;");
        $stmt->bindParam(':product', $product);
        $stmt->execute(); 
        $precio = $stmt->fetchColumn();
        $total = $precio * $cantidad;
        if (!isset($_SESSION['amount'])) {
            $_SESSION['amount'] = array();
        }
        array_push($_SESSION['amount'], $total);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
            $conn = null;
    }
}


function disBoton(){
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '  document.getElementById("compra").disabled = true;'; 
    echo '});';
    echo '</script>';
}


function decreaseStock($product, $amount){
    $conn = conn();
    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("UPDATE products SET quantityInStock = quantityInStock - :amount WHERE productCode = :productCode;");
        $stmt->bindParam(':productCode', $product);
        $stmt->bindParam(':amount', $amount);
        $stmt->execute(); 
        $conn->commit();
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
            $conn = null;
    }
}


function fetchOrders(){
    $conn = conn();
    try {
        $stmt = $conn->prepare("SELECT orderNumber, orderDate, status FROM orders WHERE customerNumber = :customernum;");
        $stmt->bindParam(':customernum', $_SESSION['customernum']);
        $stmt->execute(); 
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $pedidos;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array(); 
    } finally {
            $conn = null;
    }
}

function showorders(){
    $pedidos = fetchOrders();
    if (!empty($pedidos)) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>OrderNum</td>";
        echo "<td>OrderDate</td>";
        echo "<td>Status</td>";
        echo "</tr>";
        foreach ($pedidos as $pedido) {
            echo "<tr>";
            echo "<td>".$pedido['orderNumber']."</td>";
            echo "<td>".$pedido['orderDate']."</td>";
            echo "<td>".$pedido['status']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

function showstock(){
    $conn = conn();
    try {
        $sql = "SELECT quantityInStock FROM products WHERE productCode = :productcode";
        $consulta = $conn->prepare($sql);
        $consulta->bindParam(':productcode', $_POST['producto']);
        $consulta->execute();
        $stock = $consulta->fetchColumn();
        imprimirStock($stock);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
            $conn = null;
    }
}
function imprimirStock($stock){
    echo "Stock: ";
    echo "<input type='text' readonly value='$stock'>";
}

function showcategory(){
    $conn = conn();
    try {
        $stmt = $conn->prepare("SELECT DISTINCT productLine FROM products;");
        $stmt->execute(); 
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        imprimirCategoria($categorias);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
            $conn = null;
    }
}
function imprimirCategoria($categorias){
    foreach ($categorias as $key) {
        echo "<option value='{$key['productLine']}'>{$key['productLine']}</option>";
    }
}



function pago(){
    include './api/apiRedsys.php';
    $miObj = new RedsysAPI;
    $fuc = "999008881";
    $terminal = "1";
    $moneda = "978";
    $trans = "0";
    $url = "";
    $urlOK = "http://192.168.206.232/pedidos/hecho.php";
    $urlKO = "http://192.168.206.232/pedidos/mal.html";
    $id = intval($_SESSION['orderNum']);
    $amount = strval($_SESSION['pagar']);

    if (strpos($amount, '.')) {
        $amount = explode('.', $amount);
        $amount[1] = str_pad($amount[1], '2', '0', STR_PAD_RIGHT);
        $amount = $amount[0] . $amount[1];
    } else {
        $amount = $amount . '00';
    }
    $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
    $miObj->setParameter("DS_MERCHANT_ORDER", $id);
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
    $miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
    $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
    $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
    $miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);
    $miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);

    $version = "HMAC_SHA256_V1";
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; 

    $params = $miObj->createMerchantParameters();
    $signature = $miObj->createMerchantSignature($kc);

    echoform($version, $params, $signature);
    var_dump($_SESSION['pagar']);
}
function echoform($version, $params, $signature){
    echo "<form name='frm'  action='https://sis-t.redsys.es:25443/sis/realizarPago' method='POST' target='_blank'>
        <input type='text' hidden  name='Ds_SignatureVersion' value='$version'/></br>
        <input type='text' hidden  name='Ds_MerchantParameters' value='$params'/></br>
        <input type='text' hidden  name='Ds_Signature' value='$signature'/></br>
        <input type='submit' value='Realizar Pago'>
      </form>";
}
?>