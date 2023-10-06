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

    //apartado a

    foreach ($alumnos as $nombre => $edad) {
        echo "El alumno $nombre tiene $edad años.<br>";
    }

    //b
    echo "<br>";
    echo "Segunda posicion: " . next($alumnos) . "<br>";
    //c
    echo "Tercera posicion: " . next($alumnos) . "<br>";

    //d
    echo "Ultima posicion: " . end($alumnos) . "<br>";

    //e
    asort($alumnos);

    echo "<br>";
    echo "Primera posicion: " . current($alumnos) . "<br>";
    echo "Ultima posicion: " . end($alumnos) . "<br>";




    
    ?>


    </body>
    </html>