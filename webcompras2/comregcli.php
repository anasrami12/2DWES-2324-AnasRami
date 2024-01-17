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
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(45deg, #3498db, #8e44ad, #3498db, #8e44ad);
      background-size: 400% 400%;
      animation: gradientAnimation 15s infinite;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    form {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    h2 {
      color:green;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #333;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      padding: 10px 20px;
      font-size: 1.2em;
      cursor: pointer;
      background: #2ecc71;
      background-image: linear-gradient(45deg, #2ecc71, #27ae60);
      color: #fff;
      border: none;
      border-radius: 4px;
      transition: background 0.3s;
    }

    button:hover {
      background: #27ae60;
      background-image: linear-gradient(45deg, #27ae60, #2ecc71);
    }

    @keyframes gradientAnimation {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
  </style>
  </head>
<body>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <h2>Registro</h2>
    <label for="nif">DNI: </label>
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