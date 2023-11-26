<HTML>
<HEAD><TITLE> EJ4B – Tabla Multiplicar</TITLE></HEAD>
<BODY>
<?php
$num="8";
$cont=1;
while ($cont<=10){
$resultado=$num*$cont;//declaramos el valor de resultado para evitar tener que usar mas lineas de codigo de las necesarias
echo $num, " x " ,$cont," = ",$resultado;
echo "<br>"; //utilizamos un echo para imprimir el valor directamente de nuestras variables
$cont=$cont+1; //incrementamos el contador para rellenar la tabla entera hasta el 10 en este caso



}



?>
</BODY>
</HTML>