<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h2>Cambio Departamento</h2>

    <form method="post">
        <label for="empleados">Nombre del empleado:</label>
        <select name='empleados'>
<?php
include 'funciones.php';
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "webemple";
selectEmpleado($servername,$dbname,$username,$password);
mostrardpto($servername,$username,$password,$dbname);
?>
<br>
<label for="fechacambio">Fecha del cambio:</label>
<input type='date' name='fechacambio'>
<?php
if (($_SERVER["REQUEST_METHOD"] == "POST") ) {
function cambiodpto($servername,$dbname,$username,$password){
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // prepare sql and bind parameters
    $stmt = $conn->prepare("UPDATE emple_depart SET fecha_fin = :fecha_fin WHERE dni = :dni;");
    $stmt2 = $conn->prepare("INSERT INTO emple_depart(dni,cod_dpto,fecha_ini) VALUES ('X0221522V','D003','2023-04-12');");
    $stmt->bindParam(':dni', $dni);
    $stmt -> bindParam(':fecha_fin',$fechafin);

    $stmt2 -> bindParam(':dni', $dni);
    $stmt2 -> bindParam(':cod_dpto', $dpto);
    $stmt2 -> bindParam(':fecha_ini', $fechaini);
    

    $fechaini= $_POST['fechacambio'];
    $dpto=$_POST['dpto'];
    $fechafin = $_POST['fechacambio'];
    $dni = $_POST['empleados'];
    $stmt->execute();
    $stmt2->execute();
    echo 'Cambio de departamento realizado';
        } catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    cambiodpto($servername,$dbname,$username,$password);
}
?>
<br>
 <button type="submit">Enviar</button>
    </form>
</body>
</html>