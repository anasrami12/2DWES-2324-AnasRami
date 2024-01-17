<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header( 'Location: nologin.html');
  }else{
   if (!isset($_SESSION['historial'])) {
    $_SESSION['historial']=array();
   }
   if (!isset($_SESSION['compra'])) {
        echo "No ha hecho ninguna compra";
   }else{
    array_push($_SESSION['historial'], $_SESSION['compra']);
    var_dump($_SESSION['historial']);
     unset($_SESSION['compra']);
   }
   
    

  }

?>