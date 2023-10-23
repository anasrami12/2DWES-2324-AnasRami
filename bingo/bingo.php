<?php
///////Generar los arrays///////////////////////////////////////////
$bombo= array();
$j=1;
for ($i=0; $i <60 ; $i++) { 
    $bombo[$i]=$j;
    $j++;
}
shuffle($bombo);
$jugadores = array('jugador1','','');

$jugadores['jugador1']= array('carton1','','');

$jugador1['carton1'] = array();
//mientras el tamaño de carton1 sea menor a 15 se ejecutara el while
while (count($jugador1['carton1']) < 15) {
    $random = rand(1,60);
    // generamos el numero SOLO si no se encuentra en el array
    if (!in_array($random, $jugador1['carton1'])) {
        $jugador1['carton1'][] = $random;
    }
}

////////////////////////////////////////////////////////////////////
///////////////Operaciones//////////////////////////////////////////

$aciertos=0;
while ($aciertos<15) {
    for ($i=0; $i <60; $i++) { 
        if (in_array($bombo[$i], $jugador1['carton1'])) {
            $aciertos++;
    
        }
    }
}

echo $aciertos;
var_dump($jugador1['carton1']);
var_dump($bombo);

?>