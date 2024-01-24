<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> INICIO </h1>
    <?php
    include 'functions.php';
    checklog();
?>
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<a href="pe_altaped.php">Realizar un pedido </a><br>
<a> Info de los pedidos </a><br>
<a> Stock </a>
<br>
<input type="submit" name="loginOff" value="LogOff">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   logoff();
}

?>
</body>
</html>