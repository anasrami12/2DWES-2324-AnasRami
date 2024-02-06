<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Login</H1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label for="user">User: </label>
    <input type="text" name="user" id="user"><br>
    <label for="password">Password: </label>
    <input type="text" name="password" id="password">
    <br> <input type="submit" name="submit" value="Submit">
</form>


<?php
include 'functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user= $_POST['user'];
    $password = $_POST['password'];
   login($user,$password);

}

?>
</body>
</html>