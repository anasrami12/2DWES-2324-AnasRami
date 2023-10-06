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
        <th>Suma</th>
    </tr>
    <?php
    $impar = array("1", "3", "5", "7", "9", "11", "13", "15", "17", "19");
    $contador = 0;
    $sumaAcumulativa = 0;

    for ($fila = 1; $fila <= 10; $fila++) {
        echo "<tr>";
        echo "<td>$contador</td>"; // indice
        echo "<td>" . $impar[$contador] . "</td>"; // valor
        
        $sumaAcumulativa += $impar[$contador];
        
        echo "<td>$sumaAcumulativa</td>"; // suma
        
        $contador++;
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

