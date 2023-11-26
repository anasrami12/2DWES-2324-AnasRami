<HTML>
<HEAD><TITLE> EJ2-Conversion IP Decimal a Binario </TITLE></HEAD>
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
echo "Base 2: ";
echo $restoInverso;
echo "<br>"; 
$numero = 156;
$resto3 = ""; 

while ($numero > 0) {
    $restoDiv = $numero % 3;
    $numero = floor($numero / 3);
    $resto3 .= $restoDiv; // añadimos el resto
}
$restoInverso3 = strrev($resto3); //le damos la vuelta
echo "Base 3: ";
echo $restoInverso3; 
echo "<br>"; 

$numero = 156;
$resto4 = ""; 

while ($numero > 0) {
    $restoDiv = $numero % 4;
    $numero = floor($numero / 4);
    $resto4 .= $restoDiv; // añadimos el resto
}
$restoInverso4 = strrev($resto4); //le damos la vuelta
echo "Base 4: ";
echo $restoInverso4;
echo "<br>";  
$numero = 156;
$resto5 = ""; 

while ($numero > 0) {
    $restoDiv = $numero % 5;
    $numero = floor($numero / 5);
    $resto5 .= $restoDiv; // añadimos el resto
}
$restoInverso5 = strrev($resto5); //le damos la vuelta
echo "Base 5: ";
echo $restoInverso5; 
echo "<br>"; 
$numero = 156;
$resto6 = ""; 

while ($numero > 0) {
    $restoDiv = $numero % 6;
    $numero = floor($numero / 6);
    $resto6 .= $restoDiv; // añadimos el resto
}
$restoInverso6 = strrev($resto6); //le damos la vuelta
echo "Base 6: ";
echo $restoInverso6; 
echo "<br>"; 
$numero = 156;
$resto7 = ""; 

while ($numero > 0) {
    $restoDiv = $numero % 7;
    $numero = floor($numero / 7);
    $resto7 .= $restoDiv; // añadimos el resto
}
$restoInverso7 = strrev($resto7); //le damos la vuelta
echo "Base 7: ";
echo $restoInverso7; 
echo "<br>"; 
$numero = 156;
$resto8 = ""; 

while ($numero > 0) {
    $restoDiv = $numero % 8;
    $numero = floor($numero / 8);
    $resto8 .= $restoDiv; // añadimos el resto
}
$restoInverso8 = strrev($resto8); //le damos la vuelta
echo "Base 8: ";
echo $restoInverso8; 
echo "<br>"; 

$numero = 156;
$resto9 = ""; 

while ($numero > 0) {
    $restoDiv = $numero % 9;
    $numero = floor($numero / 9);
    $resto9 .= $restoDiv; // añadimos el resto
}
$restoInverso9 = strrev($resto9); //le damos la vuelta
echo "Base 9: ";
echo $restoInverso9; 
echo "<br>"; 
?>


</BODY>
</HTML>
