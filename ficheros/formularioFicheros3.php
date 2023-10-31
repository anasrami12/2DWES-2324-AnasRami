
    <?php
   $file=fopen('datos1.txt',"r");
   $lineas=file("datos1.txt");
   $contar=count($lineas);
   
   for ($i=0; $i < count($lineas) ; $i++) { 
    echo "<table border='1'>";
  echo "<tr><td>$lineas[$i]</td> </tr>";
   }

echo "Numero de filas: ".$contar;
    ?>
