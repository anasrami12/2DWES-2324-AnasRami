<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>


    <?php
     $alumnos = [
        "Anas" => 18,
        "Marcos" => 20,
        "Pedro" => 17,
        "David" => 24,
        "Andres" => 22
    ];

    $valorMayor = max($alumnos);


    $valorMenor = min($alumnos);

    $suma = array_sum($alumnos);
    $cantidad = count($alumnos);

    $media= $suma/$cantidad;

    echo "Max " .$valorMayor;
    echo "<br>";
    echo "Min " .$valorMenor;
    echo "<br>";
    echo "Media " .$media;



    ?>


    </body>
    </html>