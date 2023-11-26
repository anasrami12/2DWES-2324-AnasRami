<!DOCTYPE html>
<html>
<head>
    <title>EJ5B – Tabla Multiplicar</title>
</head>
<body>
    

    <table border=3>
        <?php
        $num = 8;
        $cont = 1;
        while ($cont <= 10) {
            $resultado = $num * $cont;
            echo "<tr>";
            echo "<td>$num x $cont</td>";
            echo "<td>$resultado</td>";
            echo "</tr>";
            $cont = $cont + 1;
        }
        ?>
    </table>
</body>
</html>
