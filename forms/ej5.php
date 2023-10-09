<?php

 if (isset($_POST['enviar'])) {
    $ipDecimal = $_POST['decimal'];
    


    function binario($ip){
        $ipSeparada = explode(".", $ip);
        $seccion1 = $ipSeparada[0];
        $seccion2 = $ipSeparada[1];
        $seccion3 = $ipSeparada[2];
        $seccion4 = $ipSeparada[3];
        
        $bits1 = str_pad(decbin($seccion1), 8, '0', STR_PAD_LEFT);
        $bits2 = str_pad(decbin($seccion2), 8, '0', STR_PAD_LEFT);
        $bits3 = str_pad(decbin($seccion3), 8, '0', STR_PAD_LEFT);
        $bits4 = str_pad(decbin($seccion4), 8, '0', STR_PAD_LEFT);
        
        $devolver = "$bits1.$bits2.$bits3.$bits4";
        
        echo $devolver;
    };

    $binary=  binario($ipDecimal);
    
   /* echo "IP binaria"; 
    echo "<br>";
    echo "<input type='text' value='$binary' readonly>";
    // binario($seccion1,$seccion2,$seccion3,$seccion4);
    
    */

};

?>