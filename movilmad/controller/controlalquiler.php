<?php
include_once './model/modelalquiler.php';
checklog();
showproducts();
echo "<br>";
echo "<br>";

if (isset($_POST['agregar'])) {
    addcarrito();
 }
 if (isset($_POST['vaciar'])) {
    borrarcarrito();
 }
 if (isset($_POST['alquilar'])) {
  comprobarAlquiler();
  $matricula=$_POST['vehiculos'];
  estadoVehiculo($matricula);

 }
 if (isset($_POST['logoff'])) {
  logoff();
 }
?>
