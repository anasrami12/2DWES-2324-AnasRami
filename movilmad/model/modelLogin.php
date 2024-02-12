<?php
function datadb(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "movilmad";

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
        $stmt = $conn->prepare("SELECT nombre from rclientes where email= :usuario AND idcliente =:contra;");
        $stmt->bindParam(':usuario', $user);
        $stmt->bindParam(':contra', $pass);

        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($info)) {
            $name = $info[0]['nombre'];
            session_start();
            $_SESSION['email'] = $user;
            $_SESSION['nombre'] = $name;
            $_SESSION['idcliente'] = $pass;
            header('Location: Welcome.php');
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
        echo "LOGIN FALLIDO";
        //header('Location: nologin.html');
        exit;
    } else {
        echo "<h4>Welcome " . $_SESSION['name']. "</h4>";
        echo "<br>";
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
?>