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
          $_SESSION['user']=$user;
          echo "Welcome " . $name;
      } else {
          echo "Usuario o contraseña incorrectos";
      }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}


?>