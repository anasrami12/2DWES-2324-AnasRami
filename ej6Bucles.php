<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
//Mostrar por pantalla el factorial de un número usando bucles.
$num=5;

//el factorial de 4 seria 1*2*3*4=26 (1*2=2, 2*3=6, 6*4=24)
$fact=1;
$cont=1;
$numbucle=$num+1;
while ($cont<$numbucle) {
$fact=$fact*($cont);
$cont=$cont+1;
    
}
echo "El factorial de ", $num ," es: ";
echo $fact;

?>


</BODY>
</HTML>
