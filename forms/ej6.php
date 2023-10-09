<?php
//DEFINIR FUNCIONES

function limpiarCadena($cadena) {
    $cadena = trim($cadena);
    $cadena = str_replace(
        array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'),
        array('a', 'e', 'i', 'o', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'N'),
        $cadena
    );
    $cadena = preg_replace('/[^a-zA-Z0-9\s]/', '', $cadena);
    return $cadena;
};

function imprimirDatos($name,$surname,$email,$gender){
echo "<table border='1'>";

echo "<tr>";
echo"<td><b>Nombre</b></td>";
echo"<td><b>Apellidos</b></td>";
echo"<td><b>Email</b></td>";
echo"<td><b>Sexo</b></td>";
echo "</tr>";

echo "<tr>";
echo"<td>$name</td>";
echo"<td>$surname</td>";
echo"<td>$email</td>";
echo"<td>$gender</td>";
echo "</tr>";

};



//definir variables
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$apellido2=$_POST['apellido2'];
$correo=$_POST['email'];
if ($_POST['sexo']=='hombre') {
    $sexo='H';
}elseif ($_POST['sexo']=='mujer') {
    $sexo='M';
};
$apellidos=$apellido . " " . $apellido2;

//LLAMAR A FUNCIONES
    //limpiamos cadenas
    limpiarCadena($nombre);
    limpiarCadena($apellido);
    limpiarCadena($apellido2);
    limpiarCadena($correo);
    imprimirDatos($nombre,$apellidos,$correo,$sexo);

?>