<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<table border="1">
    <tr>
        <th>Indice</th>
        <th>Valor</th>
        <th>Media Pares</th>
        <th>Media Impares</th>
    </tr>
    <?php
    $impar = array("1", "3", "5", "7", "9", "11", "13", "15", "17", "19");


    $contador = 0;

    
    $sumaPares = 0;
    $sumaImpares = 0;
    $contadorPares = 0;
    $contadorImpares = 0;

    for ($fila = 1; $fila <= 10; $fila++) {
        echo "<tr>";
        echo "<td>$contador</td>"; 
        echo "<td>" . $impar[$contador] . "</td>"; 

    
        if ($contador % 2 == 0) {
            $sumaPares += $impar[$contador];
            $contadorPares++;
        } else {
            $sumaImpares += $impar[$contador];
            $contadorImpares++;
        }

        echo "<td></td>"; 
        echo "<td></td>"; 

        $contador++;
        echo "</tr>";
    }
    ?>

    <?php
    // mostrar la media de pares e impares al final
    echo "<tr>";
    echo "<td></td>"; 
    echo "<td>Total:</td>"; 
    echo "<td>";
    if ($contadorPares > 0) {
        echo $sumaPares / $contadorPares;
    }
    echo "</td>";
    echo "<td>";
    if ($contadorImpares > 0) {
        echo $sumaImpares / $contadorImpares;
    }
    echo "</td>";
    echo "</tr>";
    ?>
</table>

</body>
</html>
