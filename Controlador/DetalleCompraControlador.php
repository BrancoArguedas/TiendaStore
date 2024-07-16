<?php

session_start();

if ( !isset($_SESSION['cliente_id']) ){
    header("Location: ../Vista/Login.php");
}else{
    echo 'listo para la compra';
}


?>