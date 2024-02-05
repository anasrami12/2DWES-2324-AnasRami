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
<input type="submit" name="compra" id="compra"  value="Finalizar compra">
</form>
<?php
if (isset($_POST['validar'])) {
    $code=$_POST['selprod'];
    $quantity=$_POST['cantidad'];
    stockCheck($code,$quantity);
}
if (isset($_POST['compra'])) {
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $clave => $infoProducto) {     
        amount($infoProducto['product'],$infoProducto['quantity']);
            }
    }else {
    echo 'Añada productos';
    }

   if (isset($_SESSION['amount'])) {
    $final= array_sum($_SESSION['amount']);
    echo "Total de la compra: ". $final;
    echo "<br>";
    disboton();
   readypay();
   
   }
   

}
if (isset($_POST['confirm'])) {
    $_SESSION['pagar']=$_SESSION['amount'][0];
    $_SESSION['amount']= array();
   $final=0;
    regexNumber($_POST['checknum']);
   }

?>

</body>
</html>