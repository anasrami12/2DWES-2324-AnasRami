<?php


 $_POST['operando'] ;
 $_POST['operando2'] ;
 $_POST['operar'];

 echo "<h1>";
 echo "Calculadora";
 echo "</h1>";

    if ($_POST['operar']=='suma') {
        echo "Resultado operacion de " . $_POST['operando']. " + " . $_POST['operando2']. " =";

      echo $_POST['operando'] + $_POST['operando2'];
      
        
    };
    if ($_POST['operar']=='resta') {
        echo "Resultado operacion de " . $_POST['operando']. " - " . $_POST['operando2']. " =";

      echo $_POST['operando'] - $_POST['operando2'];
      
        
    };
    if ($_POST['operar']=='producto') {
        echo "Resultado operacion de " . $_POST['operando']. " x " . $_POST['operando2']. " =";

      echo $_POST['operando'] * $_POST['operando2'];
      
        
    };
    if ($_POST['operar']=='division') {
        echo "Resultado operacion de " . $_POST['operando']. " / " . $_POST['operando2']. " =";

      echo $_POST['operando'] / $_POST['operando2'];
      
        
    };


?>
