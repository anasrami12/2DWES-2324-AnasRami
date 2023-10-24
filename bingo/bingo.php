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
    $jugadores['jugador1']= array('carton1','carton2','carton3');
    //rellenamos cada carton de numeros aleatorios del 1-60
    $jugador1['carton1'] = array();
    $jugador1['carton2'] = array();
    $jugador1['carton3'] = array();
    //mientras el tamaño de carton1 sea menor a 15 se ejecutara el while
    $cartones = 3;
for ($i = 1; $i <= $cartones; $i++) {
    while (count($jugador1['carton' . $i]) < 15) {
        $random = rand(1, 60);
        if (!in_array($random, $jugador1['carton' . $i])) {
            $jugador1['carton' . $i][] = $random;
        }
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
