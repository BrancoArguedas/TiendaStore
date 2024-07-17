<?php
session_start();

if (isset($_GET['indice'])) {
    $indice = $_GET['indice'];

    if (isset($_SESSION['carrito'][$indice])) {
        unset($_SESSION['carrito'][$indice]);

        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

header('Location: carritoCompra.php');
exit();
?>
