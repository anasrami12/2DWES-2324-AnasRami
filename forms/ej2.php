<?php


 $_POST['decimal'];

 if (isset($_POST['decimal'])) {
    $decimal = $_POST['decimal'];
 };





    if ($_POST['decimal']>=0) {
       $resultado = decbin($_POST['decimal']);

       echo "<h1>";
       echo "CONVERSOR A BINARIO";
       ECHO "</h1>";
      echo "Numero decimal";
      echo "<br>";
      echo "<input type='text' value='$decimal' readonly>";
      echo "<br>";
       echo "Numero binario"; 
       echo "<br>";
       echo "<input type='text' value='$resultado' readonly>";
      
       
      
        
    }else {
        echo "ERROR";
    };