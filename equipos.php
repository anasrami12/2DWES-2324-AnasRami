<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<body>
<table border="1" style="width:900px; border-collapse: collapse; text-align:center;">
    
    <tr>
    <th colspan="1">Partidos</th>
        <th colspan="8">Resultados</th>
    </tr>
    <?php
	$equipos = [
    "Barcelona", "Sevilla", "R.Madrid", "Cadiz", "At.Madrid",
    "Villareal", "Eibar", "Granada", "Espanyol", "Rayo Vall",
    "Celta", "Depor", "Valencia", "Getafe",
    "Betis", "Real Sociedad", "Levante", "Osasuna", "Mallorca",
    "Alaves", "Valladolid", "Elche", "Huesca", "Lugo",
    "Sporting Gijon", "Tenerife", "Malaga", "Las Palmas"
];
	shuffle($equipos);
	$partidos = array ();
	for ($i = 0; $i < count($equipos); $i += 2) {
   		 $partidos[] = $equipos[$i]." vs ".$equipos[$i + 1];
	}
	var_dump($partidos);
    echo "<tr>";
    echo "<th></th>";
	$tamaño = 8;
    for($i = 1; $i < $tamaño+1; $i++) {
        echo "<td rowspan >Apuesta $i</td>";
    }
    echo "</tr>";
    $quiniela = array();
    $x = array("x", 1, 2);
    for($j = 0; $j < 14; $j++) {
        echo "<tr>";
        echo "<td>"."$partidos[$j]"."</td>";
        for($i = 0; $i < 8; $i++) {
            $quiniela[$j][$i] = $x[rand(0, 2)];
            echo "<td>".$quiniela[$j][$i]."</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
</body>
</HTML>