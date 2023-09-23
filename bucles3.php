<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
// Transformar un número decimal a hexadecimal usando buclesº
$numerooriginal=222;
$numero = 222;
$resto = ""; 
while ($numero > 0) {
    $restodiv="";
    $restoDiv = $numero % 16;
    $numero = floor($numero / 16);
    if ($restoDiv=10) {
        $restoDiv="A";
    }
    if ($restoDiv=11) {
        $restoDiv="B";
    }
    if ($restoDiv=12) {
        $restoDiv="C";
    }
    if ($restoDiv=13) {
        $restoDiv="D";
    }
    if ($restoDiv=14) {
        $restoDiv="E";
    }
    if ($restoDiv=15) {
        $restoDiv="F";
    }
    
    $resto .= $restoDiv; // añadimos el resto
}
echo $resto;
$restoInverso = strrev($resto); //le damos la vuelta
echo "Numero base 10: " ,$numerooriginal;
echo "<br>";
echo "Numero base 16: ", $restoInverso;

?>


</BODY>
</HTML>
