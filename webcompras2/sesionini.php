<?php
if (!isset($_COOKIE)) {
    echo 'Acceso denegado: Sesion no iniciada';
}
else{

    echo "<form method='POST'>";
    $usuario = $_GET['usuario'];
   
    echo "Bienvenido $usuario";
    echo "<br>";
    echo "<a href='#'>Compra de productos</a>";
    echo "<br>";
    echo "<a href='#'>Consulta de compras</a>";
    echo "<br>";
    echo "<input type='submit' name='logoff' value='Cerrar Sesion'>";
    echo "</form>";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_unset();
        session_destroy();
        setcookie(session_name($usuario), '', time() - 3600, '/');
        header('Location: comlogincli.php');
        exit;
    }

}

?>