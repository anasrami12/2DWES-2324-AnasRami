<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userintroducido=$_POST['user'];
    $contraintroducida=$_POST['contra'];
   $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Insertar empleado en la tabla empleado
        $stmt = $conn->prepare("SELECT usuario,contra from cliente where usuario= :usuario AND contra=:contra;");
        $stmt -> bindParam(':usuario', $userintroducido);
        $stmt -> bindParam(':contra', $contraintroducida);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($info)) {
          $usuario = $info[0]['usuario'];
          session_name($usuario);
          session_start();
      

          header('Location: sesionini.php?usuario='.urlencode($usuario));
          exit;
      } else {
          echo "Usuario o contraseña incorrectos";
      }
      
       
       

        

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alta Categoria</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
    }
    input, button {
      margin-bottom: 16px;
    }
  </style>
  </head>
<body>
<h2>Login</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="user">Nombre de usuario </label>
    <input type="text" id="user" name="user" required>
    <br>
    <label for="contra">Contraseña</label>
    <input type="text" id="contra" name="contra" required>
    <br>
    <button type="submit">Enviar</button>
    <button type="reset">Borrar</button>
  </form>
</body>
</html>