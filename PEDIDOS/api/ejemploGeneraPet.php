<?php
// Se incluye la librería

include 'apiRedsys.php';
include 'functions.php';
checklog();
// Se crea Objeto
$miObj = new RedsysAPI;


// Valores de entrada que no hemos cmbiado para ningun ejemplo
$fuc="999008881";
$terminal="1";
$moneda="978";
$trans="0";
$url="";
$urlOKKO="http://localhost/ApiPhpRedsys/ApiRedireccion/redsysHMAC256_API_PHP_7.0.0/ejemploRecepcionaPet.php";
$id=$_SESSION['orderNum'];
$amount=$_SESSION['amount'][0];	

// Se Rellenan los campos
$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
$miObj->setParameter("DS_MERCHANT_ORDER",$id);
$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
$miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
$miObj->setParameter("DS_MERCHANT_URLOK",$urlOKKO);
$miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);

//Datos de configuración
$version="HMAC_SHA256_V1";
$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
// Se generan los parámetros de la petición
$request = "";
$params = $miObj->createMerchantParameters();
$signature = $miObj->createMerchantSignature($kc);

?>
<html lang="es">
<head>
</head>
<body>
<form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
<input type="text" hidden name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
<input type="text" hidden name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
<input type="text" hidden name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
<input type="submit" value="Realizar Pago" >
</form>

</body>
</html>
