<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <a href="./pe_inicio.php">Go back</a>
</head>
<body>
<?php
    include 'functions.php';
    checklog();
?> 

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label for="producto">Producto:</label>
<select name="producto" id="producto">
    <?php
showproducts();
?>
</select>
<input type="submit" name="comprobar" value="Comprobar Stock">
</form>
<?php
if (isset($_POST['comprobar'])) {
    showstock();
}
?>

</body>
</html>