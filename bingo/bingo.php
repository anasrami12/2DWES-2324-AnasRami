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

function generarJugadoresYCarton(){
    //generamos los jugadores
    $jugadores = array('jugador1','','');
    //en cada jugador generamos los cartones
    $jugadores['jugador1']= array('carton1','','');
    //rellenamos cada carton de numeros aleatorios del 1-60
    $jugador1['carton1'] = array();
    //mientras el tamaño de carton1 sea menor a 15 se ejecutara el while
    while (count($jugador1['carton1']) < 15) {
        $random = rand(1,60);
        // generamos el numero SOLO si no se encuentra en el array
        if (!in_array($random, $jugador1['carton1'])) {
            $jugador1['carton1'][] = $random;
        }
    }
    return $jugador1['carton1'];

}


////////////////////////////////////////////////////////////////////
///////////////Operaciones//////////////////////////////////////////
function comprobarAciertos(){
$bombo=generarBombo();
$jugador1=generarJugadoresYCarton();
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

echo comprobarAciertos();

?>
