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
<label for="producto">Categoria:</label>
<select name="categoria" id="categoria">
    <?php
    showcategory();
?>
</select>
<input type="submit" name="comprobar" value="Comprobar Stock">
</form>
<?php
if (isset($_POST['comprobar'])) {
    $database_info = datadb();
    $servername = $database_info['servername'];
    $username = $database_info['username'];
    $password = $database_info['password'];
    $dbname = $database_info['dbname'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT sum(quantityInStock) from products where productLine=:category");
        $stmt->bindParam(':category', $_POST['categoria']);
        $stmt->execute(); 
        $stocktotal = $stmt->fetchColumn();
        echo "Stock total: ".$stocktotal;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}


?>
</body>
</html>