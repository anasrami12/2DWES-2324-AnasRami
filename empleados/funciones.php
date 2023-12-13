<?php
 function adddpto($servername,$username,$password,$dbname){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlUltID = "SELECT MAX(SUBSTRING(cod_dpto, 3)) as ultid FROM departamento";
    $connUltID = $conn->prepare($sqlUltID);
    $connUltID->execute();
    $filaUltID = $connUltID->fetch(PDO::FETCH_ASSOC);

    if ($filaUltID['ultid'] !== null) {
        $ultID = intval($filaUltID['ultid']);
    } else {
        $ultID = 0;
    }
    $nuevoID = $ultID + 1;
    $id = sprintf("D%03d", $nuevoID);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO departamento (cod_dpto,nombre_dpto) VALUES (:cod_dpto,:nombre_dpto)");
        $stmt->bindParam(':cod_dpto', $id);
        $stmt->bindParam(':nombre_dpto', $nombre);
      
        // insert a row
        $nombre = $_POST['nombre'];
        $stmt->execute();
    
        echo "New records created successfully";
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
}
function mostrardpto($servername,$username,$password,$dbname){
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT cod_dpto, nombre_dpto FROM departamento";

$consulta = $conn->prepare($sql);
$consulta->execute();

$filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
echo "Departamento: ";
echo "<select name='dpto'>";
foreach ($filas as $fila) {
echo "<option value='{$fila['cod_dpto']}'>{$fila['nombre_dpto']}</option>";
}

echo "</select>";
}
function insertaremple($servername,$username,$password,$dbname){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO empleado (fecha_nac,salario,apellidos,nombre,dni) VALUES (:fecha_nac,:salario,:apellidos,:nombre,:dni)");
        $stmt2= $conn->prepare("INSERT INTO emple_depart (dni,cod_dpto,fecha_ini) VALUES (:dni,:cod_dpto,:fecha_ini)");

        $stmt->bindParam(':fecha_nac', $fechanac);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':dni', $dni);

        $stmt2->bindParam(':dni', $dni);
        $stmt2->bindParam(':cod_dpto', $departamento);
        $stmt2->bindParam(':fecha_ini', $fechaini);
      

        $departamento=$_POST['dpto'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellido'];
        $salario = $_POST['salario'];
        $fechanac = $_POST['nacimiento'];
        $fechaini = $_POST['inicio'];
        $dni = $_POST['dni'];
        $stmt->execute();
        $stmt2->execute();
    
        echo "Empleado añadido";
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
}

?>