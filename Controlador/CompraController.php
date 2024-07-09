<?php

session_start();
require_once '../Modelo/CompraModelo.php';
require_once '../Controlador/ProductoController.php';

if (isset($_SESSION['email'])) {
    if ($_POST) {
        $cliente_id = $_SESSION['cliente_id'];
        $producto_id = $_POST['producto_id'];
        $precioUnit = $_POST['precioUnit'];
        $cantidad = $_POST['cantidad'];
        $precioTotal = $_POST['subTotal'];

        $compraModelo = new Compra();
        $compra = $compraModelo->create($cliente_id, $producto_id, $precioUnit, $cantidad, $precioTotal);
        if ($compra) {
            $productoControlador = new ProductoControlador();
            $actualizarStock = $productoControlador->actualStock($producto_id, $cantidad);
            if ($actualizarStock) {
                header("Location: ../Vista/compraExitosa.php?id=" . $producto_id);
                exit;
            } else {
                echo "error al actualizar stock";
            }
        } else {
            echo "error al crear compra";
        }
    }
}else{
    header("Location: ../Vista/Login.php");
}
