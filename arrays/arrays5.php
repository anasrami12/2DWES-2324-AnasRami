<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>


    <?php
    $array1 = array('Bases Datos',' Entornos Desarrollo', 'Programacion');
    $array2= array('Sistemas Informaticos','FOL','Mecanizado');
    $array3= array('Desarrollo Web ES','Desarrollo Web EC','Despliegue','Desarrollo Interfaces', 'Ingles');
    $arrayA=array();
    $arrayB=array();
    $arrayC=array();
    //APARTADO A
    
    foreach ($array1 as $key) {
        $arrayA[].=$key;
    }
    foreach ($array2 as $key) {
        $arrayA[].=$key;
    }
    foreach ($array3 as $key) {
        $arrayA[].=$key;
    }
   var_dump($arrayA);

   //APARTADO B

   $arrayB=array_merge($array1,$array2,$array3);

   var_dump($arrayB);

   //APARTADO C
foreach ($array1 as $contenido) {
    array_push($arrayC, $contenido);
}
foreach ($array2 as $contenido) {
    array_push($arrayC, $contenido);
}
foreach ($array3 as $contenido) {
    array_push($arrayC, $contenido);
}

var_dump($arrayC);

    
    ?>


</body>
</html>