<HTML>
<HEAD> 
    <TITLE>FORMULARIO BASE</TITLE>
</HEAD>
<BODY>
    <h1>CALCULADORA</h1>
    <form name='mi_formulario' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
        Operando
        <input type='text' name='operando' value='' size="8"><br>
        Operando2
        <input type='text' name='operando2' value='' size="8"><br>

        <input type='radio' checked name='operar' value='suma'>Suma</br>
        <input type='radio' name='operar' value='resta'>Resta</br>
        <input type='radio' name='operar' value='producto'>Producto</br>
        <input type='radio' name='operar' value='division'>Division</br>

        <input type="submit" name="enviar" value="enviar">
        <input type="reset" value="borrar">
    </form>

    <?php
    if (isset($_POST['enviar'])) {
        $operando1 = $_POST['operando'];
        $operando2 = $_POST['operando2'];
        $operar = $_POST['operar'];

        if ($operar == 'suma') {
            echo "Resultado operación de " . $operando1 . " + " . $operando2 . " = " . ($operando1 + $operando2);
        } elseif ($operar == 'resta') {
            echo "Resultado operación de " . $operando1 . " - " . $operando2 . " = " . ($operando1 - $operando2);
        } elseif ($operar == 'producto') {
            echo "Resultado operación de " . $operando1 . " x " . $operando2 . " = " . ($operando1 * $operando2);
        } elseif ($operar == 'division') {
            if ($operando2 == 0) {
                echo "No se puede dividir por cero.";
            } else {
                echo "Resultado operación de " . $operando1 . " / " . $operando2 . " = " . ($operando1 / $operando2);
            }
        }
    }
    ?>
</BODY>
</HTML>
