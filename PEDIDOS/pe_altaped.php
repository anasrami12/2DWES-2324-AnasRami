<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <a href="./pe_inicio.php">Volver</a><br>
    <h1>Pedidos</h1>
    <label for="selprod">Productos: </label>
    <select name="selprod">
        <?php
        include 'functions.php';
        checklog();
        showproducts();
?>
</select>
<br>
<label for="cantidad">Cantidad: </label>
<input type="number" name="cantidad"  id="cantidad">
<br>
<input type="submit" name="validar" value="Añadir al Carrito">
<input type="submit" name="compra" value="Finalizar compra">
</form>
<?php
if (isset($_POST['validar'])) {
    $code=$_POST['selprod'];
    $quantity=$_POST['cantidad'];
    stockCheck($code,$quantity);
}

?>
</body>
</html>