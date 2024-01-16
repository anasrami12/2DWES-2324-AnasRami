<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo 'Acceso denegado: Sesion no iniciada';
}
else{

    echo "<form method='POST'>";

    echo "Bienvenido  ". $_SESSION['usuario'];
    echo "<br>";
    echo "<a href='comprocli.php'>Compra de productos</a>";
    echo "<br>";
    echo "<a href='#'>Consulta de compras</a>";
    echo "<br>";
    echo "<input type='submit' name='logoff' value='Cerrar Sesion'>";
    echo "</form>";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_unset();
        session_destroy();
        setcookie(session_name('PHPSESSID'), '', time() - 3600, '/');
        header('Location: comlogincli.php');
        exit;
    }

}

?>