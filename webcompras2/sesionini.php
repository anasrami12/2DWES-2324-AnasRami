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
      color: green;
      text-align: center;
      margin-bottom: 20px;
    }
    a {
      display: block;
      margin: 10px 0;
      color: black;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
      background-color: lightgreen;
      border-radius: 30px;
    }

    a:hover {
      color: #2980b9;
    }

    input {
      padding: 10px 20px;
      font-size: 1.2em;
      cursor: pointer;
      background: #e74c3c;
      color: #fff;
      border: none;
      border-radius: 4px;
      transition: background 0.3s;
    }

    input:hover {
      background: #c0392b;
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
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header( 'Location: nologin.html');
  }
else{

    echo "<form method='POST'>";

    echo "<h2> Bienvenido  ". $_SESSION['usuario'] . "</h2>";
    echo "<br>";
    echo "<a href='comprocli.php'>Compra de productos</a>";
    echo "<br>";
    echo "<a href='#'>Consulta de compras</a>";
    echo "<br>";
    echo "<input type='submit' name='logoff' value='Cerrar Sesion'>";
    echo "</form>";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_unset();
        session_destroy();
        setcookie(session_name('PHPSESSID'), '', time() - 3600, '/');
        header('Location: comlogincli.php');
        exit;
    }

}

?>