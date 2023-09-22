<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
$ip = "192.168.18.204"; 
$octetos = explode(".", $ip); //dividimos la ip

$ipBinaria = '';
foreach ($octetos as $octeto) {
    $binarioOcteto = str_pad(decbin($octeto), 8, '0', STR_PAD_LEFT); //para cada cadena convertimos a binario y usamos el str pad left para
    $ipBinaria .= $binarioOcteto;
}
echo "IP $ip en binario es: $ipBinaria";
?>
</BODY>
</HTML>
