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
function selectEmpleado($servername,$dbname,$username,$password){
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT dni, nombre, apellidos FROM empleado";


$consulta = $conn->prepare($sql);


$consulta->execute();


$filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($filas as $empleado) {
echo "<option value='{$empleado['dni']}'>{$empleado['nombre']} {$empleado['apellidos']}</option>";
} 
echo "</select>";
echo "<br>";
}
function cambiodpto($servername,$dbname,$username,$password){
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // prepare sql and bind parameters
    $stmt = $conn->prepare("UPDATE emple_depart SET fecha_fin = :fecha_fin WHERE dni = :dni;");
    $stmt2 = $conn->prepare("INSERT INTO emple_depart(dni,cod_dpto,fecha_ini) VALUES (:dni,:cod_dpto,:fecha_ini);");
    $stmt->bindParam(':dni', $dni);
    $stmt -> bindParam(':fecha_fin',$fechafin);

    $stmt2 -> bindParam(':dni', $dni);
    $stmt2 -> bindParam(':cod_dpto', $dpto);
    $stmt2 -> bindParam(':fecha_ini', $fechaini);
    

    $fechaini= $_POST['fechacambio'];
        echo $fechaini;
    $dpto=TRIM($_POST['dpto']);
    echo $dpto;
    $fechafin = $_POST['fechacambio'];
    echo $fechafin;
    $dni = $_POST['empleados'];
    echo $dni;
    $stmt->execute();
    $stmt2->execute();
    echo 'Cambio de departamento realizado';
        } catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    function listaemple($servername,$username,$password,$dbname){
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // prepare sql and bind parameters
            $stmt = $conn->prepare("SELECT distinct nombre,apellidos from empleado, emple_depart where empleado.dni=emple_depart.dni and fecha_fin is NULL
            and cod_dpto=:cod_dpto;");
    
            $stmt->bindParam(':cod_dpto', $cod);
    
            $cod= $_POST['dpto'];
    
            $stmt->execute();
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<br>";
    echo "Empleados: ";
    echo "<table border='2'>";
    foreach ($filas as $fila) {
    echo "<tr><td>{$fila['nombre']} {$fila['apellidos']}</td> </tr>";
    }
    echo "</table>";
           
                } catch(PDOException $e)
                {
                echo "Error: " . $e->getMessage();
                }
                $conn = null;
            }
        function histemple($servername,$username,$password,$dbname){
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // prepare sql and bind parameters
                    $stmt = $conn->prepare("SELECT distinct nombre,apellidos from empleado, emple_depart where empleado.dni=emple_depart.dni and fecha_fin is NOT NULL
                    and cod_dpto=:cod_dpto;");
            
                    $stmt->bindParam(':cod_dpto', $cod);
            
                    $cod= $_POST['dpto'];
            
                    $stmt->execute();
                    $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo "<br>";
            echo "Empleados: ";
            echo "<table border='2'>";
            foreach ($filas as $fila) {
            echo "<tr><td>{$fila['nombre']} {$fila['apellidos']}</td> </tr>";
            }
            echo "</table>";
                   
                        } catch(PDOException $e)
                        {
                        echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                    }

                    function modsalario($servername,$dbname,$username,$password){
                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            // prepare sql and bind parameters
                            $stmt = $conn->prepare("UPDATE empleado
                            SET salario = salario + (salario * :porcentaje)
                            WHERE dni = :dni ;");
                    
                            $stmt->bindParam(':porcentaje', $porcentaje);
                            $stmt->bindParam(':dni', $dni);
                    
                            $salario=$_POST['salario'];
                           $porcentaje=$salario/100;
                           $dni=$_POST['empleados'];
                    
                            $stmt->execute();
                           echo 'Salario cambiado correctamente';
                                } catch(PDOException $e)
                                {
                                echo "Error: " . $e->getMessage();
                                }
                                $conn = null;
                            }

                            FUNCTION buscarfecha($servername,$dbname,$username,$password){
                                try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    // prepare sql and bind parameters
                                    $stmt = $conn->prepare("SELECT empleado.nombre, empleado.apellidos, emple_depart.cod_dpto 
                                    from empleado,emple_depart where fecha_ini<= :fecha AND fecha_fin>=:fecha and empleado.dni=emple_depart.dni;");
                            
                                    $stmt->bindParam(':porcentaje', $porcentaje);
                                    $stmt->bindParam(':fecha', $fecha);
                            
                                    $fecha=$_POST['fecha'];
                            
                                    $stmt->execute();
                                    $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    echo "<table border='2'>";
                                    echo "<tr><td>EMPLEADO</td><td>DEPARTAMENTO</td> </tr>";
                                        foreach ($filas as $fila) {
                                        echo "<tr><td>{$fila['nombre']} {$fila['apellidos']}</td><td>{$fila['cod_dpto']}</td> </tr>";
                                        }
                                        echo "</table>";
                                        } catch(PDOException $e)
                                        {
                                        echo "Error: " . $e->getMessage();
                                        }
                                        $conn = null;
                            }
                    
?>