 <?php
    if (isset($_POST['enviar'])) {
        $numero = $_POST['decimal'];
        $operar = $_POST['operar'];

        
        function binario($num){
            $bin= decbin($num);
            echo '<table border="1">';
            echo '<tr><th>Binario</th> ' ;
            echo'<th>';
            echo $bin; echo ' </th></tr>';
            
        };

        function octal($num){
            $oct= decoct($num);
            echo '<table border="1">';
            echo '<tr><th>Octal</th> ' ;
            echo'<th>';
            echo $oct; echo ' </th></tr>';
            
        };

        function hexa($num){
            $hex= dechex($num);
            echo '<table border="1">';
            echo '<tr><th>Hexadecimal</th> ' ;
            echo'<th>';
            echo $hex; echo ' </th></tr>';
            
        };

        function todo($num){
            $bin= decbin($num);
            $oct= decoct($num);
            $hex= dechex($num);
            echo '<table border="1">';
            echo '<tr><th>Hexadecimal</th> ' ;
            echo'<th>';
            echo $hex; echo ' </th></tr>';
            echo '<tr><th>Binario</th> ' ;
            echo'<th>';
            echo $bin; echo ' </th></tr>';
            echo '<tr><th>Octal</th> ' ;
            echo'<th>';
            echo $oct; echo ' </th></tr>';

        };

        if ($operar=='binario') {
            return binario($numero);
        }elseif ($operar=='octal') {
            return octal($numero);
        }elseif ($operar=='hexadecimal') {
            return hexa($numero);
        }elseif ($operar=='todos') {
            return todo($numero);
        }
    
    }
    ?>