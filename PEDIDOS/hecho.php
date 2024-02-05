<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include 'functions.php';
    session_start();
dates();
        
        foreach ($_SESSION['carrito'] as $clave => $infoProducto) {     
            decreaseStock($infoProducto['product'],$infoProducto['quantity']);
                }
    ?>
    <h3>Pedido Realizado</h3>
    <a href="./pe_inicio.php">Volver al inicio</a>
</body>
</html>