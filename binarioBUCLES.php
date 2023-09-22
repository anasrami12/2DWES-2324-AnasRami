<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
//Programa ej1b.php: Transformar un número decimal a binario usando bucles (no se podrá utiliza la función decbin)
$numero = 156;
$resto = ""; 

while ($numero > 0) {
    $restoDiv = $numero % 2;
    $numero = floor($numero / 2);
    $resto .= $restoDiv; // añadimos el resto
}

$restoInverso = strrev($resto); //le damos la vuelta

echo $restoInverso; 

?>


</BODY>
</HTML>
