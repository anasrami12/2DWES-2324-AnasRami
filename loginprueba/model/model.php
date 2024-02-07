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

function conn(){
    $database_info = datadb();

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
            header('Location: logueado.html');
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
    } else {
        echo "<h4>Welcome " . $_SESSION['name']. "</h4>";
        echo "<br>";
    }
}
?>
