<?php

session_start();
require_once '../Modelo/CompraModelo.php';
require_once '../Modelo/ProductoModelo.php';
require_once '../Modelo/DetalleCompraModelo.php';

$detalleCompraModel = new DetalleCompra();

if (isset($_SESSION['email'])) {
    if ($_POST) {
        $cliente_id = $_SESSION['cliente_id'];
        $precioTotal = 0;
        $fechaCompra = date('d-m-Y H:i:s');

        $compraModelo = new Compra();
        $compra = $compraModelo->create($cliente_id, $precioTotal, $fechaCompra);
        if ($compra) {
            $actualCompra = $compraModelo->getCompraById();
            $pagoTotal = $detalleCompraModel->getPagoTotal($actualCompra['id']);
            $compraModelo->currentPagoTotal($pagoTotal, $actualCompra['id']);
            $productoControlador = new Producto();
            $actualizarStock = $productoControlador->updateStock($producto_id, $cantidad);
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
