<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<table border="1">
    <tr>
        <th>Indice</th>
        <th>Binario</th>
        <th>Octal</th>
    </tr>
    <?php
   //calcular binario
   $numeros = array();
   $cont="";
   $num="";
   while ($cont<20){
    $num=decbin($cont);
    array_push($numeros,$num);
    $cont++;
};
//calcular octal
$numeros2 = array();
   $cont2="";
   $num2="";
   while ($cont2<20){
    $num2=decoct($cont2);
    array_push($numeros2,$num2);
    $cont2++;
};

$k=0;
$reverso= array_reverse($numeros);
//imprimir todo
for($i=0;$i<20;$i++){
    
    echo "<tr>";
    echo "<td> $k </td>";
    print "<td>$reverso[$i] </td>";
    print "<td>$numeros2[$i] </td>";
    echo "</tr>";
$k++;
};

    ?>
</table>

</body>
</html>


