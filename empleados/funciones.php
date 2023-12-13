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
    
        echo "Departamento creado";
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
}

?>
