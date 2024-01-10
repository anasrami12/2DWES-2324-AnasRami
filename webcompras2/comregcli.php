<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $nif = $_POST['nif'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cp = $_POST['cp'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $usuario=$_POST['nombre'];
        $contra=strrev($_POST['apellido']);
        // Insertar empleado en la tabla empleado
        $stmt = $conn->prepare("INSERT INTO cliente (nif, nombre, apellido, cp, direccion, ciudad, usuario, contra) VALUES (:nif, :nombre, :apellido, :cp, :direccion, :ciudad, :usuario, :contra)");
        $stmt->bindParam(':nif', $nif);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':cp', $cp);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':ciudad', $ciudad);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contra', $contra);
        $stmt->execute();
        echo "Cliente añadido correctamente.";
        setcookie($usuario, $contra, time() + (86400 * 30), "/"); 

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
<!-- Resto de tu código HTML -->
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
<h2>Dar de Alta a Empleados</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="nif">DNI del Empleado: </label>
    <input type="text" id="nif" name="nif" required>
    <br>
    <label for="nombre">Nombre del Usuario: </label>
    <input type="text" id="nombre" name="nombre" required>
    <br>
    <label for="apellido">Apellido del Usuario: </label>
    <input type="text" id="apellido" name="apellido" required>
    <br>
    <label for="cp">Codigo Postal: </label>
    <input type="text" id="cp" name="cp" required>
    <br>
    <label for="direccion">Direccion: </label>
    <input type="text" id="direccion" name="direccion" required>
    <br>
    <label for="ciudad">Ciudad: </label>
    <input type="text" id="ciudad" name="ciudad" required>
    <br>
    <button type="submit">Enviar</button>
    <button type="reset">Borrar</button>
  </form>
</body>
</html>