<?php
$numeroJugadores=2;
$numeroCartones=1;
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


 var_dump(generarJugadoresYCarton($numeroJugadores,$numeroCartones)) ;
////////////////////////////////////////////////////////////////////
///////////////Operaciones//////////////////////////////////////////
function comprobarAciertos($numeroJugadores,$numeroCartones){
    //llamamos al bombo
$bombo=generarBombo();
//llamamos a los jugadores con sus respectivos cartones
$jugadores=generarJugadoresYCarton($numeroJugadores,$numeroCartones);
$aciertos=array();
$cont=0;
   //aqui ya tenemos los aciertos segun el numero de jugadores
    for ($i=1; $i <= $numeroJugadores ; $i++) { 
        $aciertos['aciertos'.$i]=0;
        
        }


      for ($j=1; $j <= count($jugadores) ; $j++) { 
        while ($aciertos["aciertos$j"]<15) {
            for ($c=0; $c < 15; $c++) { 
                if (in_array($bombo[$cont], $jugadores["jugador$j"][$c])) {
                    $aciertos["aciertos$j"]++;
                    
            
                }      
            }
            
    
            $cont++;
        
        
        }
      }
    
    
   /* while ($aciertos<15) {
            if (in_array($bombo[$cont], $jugador1)) {
                $aciertos++;
                
        
            }
    
            $cont++;
        
        
    }
    
    return $aciertos;*/
    //return var_dump($aciertos);
    return var_dump($aciertos);
}

return comprobarAciertos($numeroJugadores,$numeroCartones);


?>