<?php


 $_POST['operando'] ;
 $_POST['operando2'] ;
 $_POST['operar'];
 echo "<h1>CALCULADORA</h1>
 <form name='mi_formulario' action='ej1.php' method='post'>
     Operando
 <input type='text' name='operando' value='' size="8"><br>
 Operando2
 
 <input type='text' name='operando2' value='' size="8"><br>
 
 
 <input type='radio' checked name='operar' value='suma'>Suma</br>
 <input type='radio' name='operar' value='resta'>Resta</br>
 <input type='radio' name='operar' value='producto'>Producto</br>
 <input type='radio' name='operar' value='division'>Division</br>
 
 
 <input type="submit" value="enviar">
 
 <input type="reset" value="borrar">
 ";
 echo "<br>";

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
