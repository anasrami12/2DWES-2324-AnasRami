<?php

 if (isset($_POST['enviar'])) {
    $numeroCompleto = $_POST['numero'];
    $baseFinal = $_POST['base'];
    
    $separador= explode('/',$numeroCompleto);
    
    $numero= $separador[0]; //aqui conseguimos el numero 
    $baseOriginal= $separador[1]; //aqui conseguimos la base del numero
    
    function cambioBase($num,$b,$b2){
        $resultado= base_convert($num, $b, $b2);
        echo $resultado;
    };
   echo "El numero $numero convertido a base $baseFinal es: ";
   return cambioBase($numero,$baseOriginal,$baseFinal);


};

?>