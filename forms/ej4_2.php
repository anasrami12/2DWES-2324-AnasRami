<HTML>
<HEAD> 
    <TITLE>FORMULARIO BASE</TITLE>
</HEAD>
<BODY>
    <h1>CAMBIO DE BASE</h1>
    <form name='mi_formulario' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
        Numero 
        <input type='text' name='numero' value='' size="8"><br>
       Nueva base
<input type='text' name='base' value='' size="8"><br>

        <input type="submit" name="enviar" value="Cambio de base">
        <input type="reset" value="borrar">
    </form>
    <?php

 if (isset($_POST['enviar'])) {
    $numeroCompleto = $_POST['numero'];
    $baseFinal = $_POST['base'];
    
    $separador= explode('/',$numeroCompleto);
    
    $numero= $separador[0]; //aqui conseguimos el numero 
    $baseOriginal= $separador[1]; //aqui conseguimos la base del numero
    
    function cambioBase($num,$b,$b2){
        $resultado= base_convert($num, $b, $b2);
        echo $resultado;
    };
   echo "El numero $numero convertido a base $baseFinal es: ";
   return cambioBase($numero,$baseOriginal,$baseFinal);


};

?>
    </BODY>
</HTML>