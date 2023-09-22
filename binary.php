<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
$ip = "192.168.18.204"; 
$dividir = explode(".", $ip);//dividir
$binario = sprintf("%b.",$dividir);
$ipBinaria = sprintf("%08b%08b%08b%08b", $dividir[0], $dividir[1], $dividir[2], $dividir[3]);//conversion a binario
echo "IP $ip en binario es: $ipBinaria";  



?>
</BODY>
</HTML>