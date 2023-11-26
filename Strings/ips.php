<!DOCTYPE html>
<html>
<body>

<?php

$ip_masc="192.168.16.100/16";

//Calcular mascara
$ip_separada=explode("/",$ip_masc);
$ip=$ip_separada[0];													
$MascaraDec=$ip_separada[1];
echo "IP: ".$ip;
echo "</br>";
echo "Máscara: ".$MascaraDec;
echo "</br>";

//Separar ip
$ArrayIpDec=explode(".",$ip);
$ArrayIpBin=[];
for($i=0;$i<4;$i++){
	$aux=decbin($ArrayIpDec[$i]);
  	$ArrayIpBin[$i]=str_pad($aux,8,"0",STR_PAD_LEFT);
}

//Calculamos los bits correspondientes
$bit=32-$MascaraDec;

//Ejecutamos la funcion BinArrayString
$IpBinString=BinArrayString($ArrayIpBin);

//Eliminamos los bits necesarios
$IpBinString_Cortada=substr($IpBinString,0,-$bit);


$IpBinDiRed=str_pad($IpBinString_Cortada,32,"0",STR_PAD_RIGHT);			
$IpBinDiRedArray=BinStringArray($IpBinDiRed);							
$IpBinDiRedString=ArrayBinStringDec($IpBinDiRedArray);					
$IpBinDiRedString=substr($IpBinDiRedString,0,-1);						
echo  "Dirección de Red: ".$IpBinDiRedString;
echo "</br>";

$IpBinBro=str_pad($IpBinString_Cortada,32,"1",STR_PAD_RIGHT);			
$IpBinBroArray=BinStringArray($IpBinBro);								
$IpBinBroString=ArrayBinStringDec($IpBinBroArray);						
$IpBinBroString=substr($IpBinBroString,0,-1);							
echo "Direccion De Broadcast: ".$IpBinBroString;
echo "</br>";
																		

$Rango1DecArray=ArrayBinArrayDec($IpBinDiRedArray);						
$Rango1DecArray[3]=$Rango1DecArray[3]+1;							
$Rango1String=ArrayString($Rango1DecArray);								
$Rango1String=substr($Rango1String,0,-1);								

$Rango2DecArray=ArrayBinArrayDec($IpBinBroArray);						
$Rango2DecArray[3]=$Rango2DecArray[3]-1;								
$Rango2String=ArrayString($Rango2DecArray);								
$Rango2String=substr($Rango2String,0,-1);								
echo "Rango: ".$Rango1String." a ".$Rango2String;



//convierte array a string concatenado

function ArrayString($array){
	$string="";
	for($j=0;$j<sizeof($array);$j++){
		$string.=$array[$j].".";
    }
	return $string;
}

//PASA UN ARRAY DE BINARIO A DECIMAL

function ArrayBinArrayDec($array){
	$arraydec=[];
	for($j=0;$j<sizeof($array);$j++){
		$arraydec[$j]=bindec($array[$j]);
    }
	return $arraydec;
}

//transforma el broadcast binario a una direccion decimal string

function ArrayBinStringDec($array){
	$stringdec="";
	for($j=0;$j<sizeof($array);$j++){
		$stringdec.=bindec($array[$j]).".";
    }
	return $stringdec;
}

//transformar la ip en binario de Array a String

function BinArrayString($array){
	$IpBinString="";
	foreach($array as $x){
		$IpBinString.=$x;
	}
	return $IpBinString;
}

//transforma la direccion de red binaria de string a array

function BinStringArray($string){
	$ArrayBin=str_split($string, 8);
	return $ArrayBin;
}

?>

</body>
</html>