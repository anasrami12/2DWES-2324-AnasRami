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
    $daw=array();
    $daw=array_merge($array1,$array2,$array3);
    $i=array_search("Mecanizado",$daw);

    if ($i==true) {
        unset($daw[$i]);
    }
    
    $daw =array_reverse($daw);

    var_dump($daw);
    ?>


    </body>
    </html>