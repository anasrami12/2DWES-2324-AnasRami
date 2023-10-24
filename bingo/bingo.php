<?php
///////Generar los arrays///////////////////////////////////////////
function generarBombo(){
//lo rellenamos del 1-60
    $bombo= array();
    $j=1;
    for ($i=0; $i <60 ; $i++) { 
        $bombo[$i]=$j;
        $j++;
    }
    shuffle($bombo);  //mezclamos los numeros para que siempre sea diferente  
return $bombo;
}

function generarJugadoresYCarton($numeroJugadores, $numeroCartones) {
    // creamos los arrays
    $jugadores = array();
    
    for ($j = 1; $j <= $numeroJugadores; $j++) {
        // generamos los cartones
        $cartones = array();
        for ($c = 1; $c <= $numeroCartones; $c++) {
            $carton = array();
            while (count($carton) < 15) {
                $random = rand(1, 60);
                if (!in_array($random, $carton)) {
                    $carton[] = $random;
                }
            }
            $cartones[] = $carton;
        }

        // añadimos al jugador y sus cartones al array de jugadores
        $jugadores["jugador$j"] = $cartones;
    }

    return $jugadores;
}


 var_dump(generarJugadoresYCarton(3,3)) ;
////////////////////////////////////////////////////////////////////
///////////////Operaciones//////////////////////////////////////////
function comprobarAciertos(){
$bombo=generarBombo();
$jugador=generarJugadoresYCarton();
$player1=$jugador['jugador1'];
$carton=$player1['carton1'];
var_dump($player1);
    $aciertos=0;
    $cont=0;
    while ($aciertos<15) {
            if (in_array($bombo[$cont], $jugador1)) {
                $aciertos++;
                
        
            }
    
            $cont++;
        
        
    }
    
    return $aciertos;
}



?>
