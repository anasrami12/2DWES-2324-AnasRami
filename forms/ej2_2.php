<HTML>
<HEAD> <TITLE> FORMULARIO BASE </TITLE>
</HEAD>
<BODY>
    <h1>CONVERSOR A BINARIO</h1>
<form name='mi_formulario' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
    Numero decimal
<input type='text' name='decimal' value='' size="8" ><br>



<input type="submit" value="enviar" name="enviar">

<input type="reset" value="borrar">

<?php
 if (isset($_POST['enviar'])) {
    if (isset($_POST['decimal'])) {
        $decimal = $_POST['decimal'];
     };
    if ($_POST['decimal']>=0) {
        $resultado = decbin($_POST['decimal']);
        echo "<br>";
        echo "Numero binario"; 
        echo "<br>";
        echo "<input type='text' value='$resultado' readonly>";
       
        
       
         
     }else {
         echo "ERROR";
     };




 };


?>

</FORM>
</BODY>
</HTML>