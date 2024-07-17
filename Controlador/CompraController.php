<?php

session_start();
require_once '../Modelo/CompraModelo.php';
require_once '../Modelo/ProductoModelo.php';
require_once '../Modelo/DetalleCompraModelo.php';

$detalleCompraModel = new DetalleCompra();
$compraModel = new Compra();
$productoModel = new Producto();

if (isset($_SESSION['email'])) {
    if ($_POST) {
        $cliente_id = $_SESSION['cliente_id'];
        $precioTotal = 0;
        $fechaCompra = date('Y-m-d H:i:s');

        $compra = $compraModel->create($cliente_id, $precioTotal, $fechaCompra);

        foreach ($_SESSION['carrito'] as $indice => $producto){
            $producto_id = $producto['producto_id']; 
            $precioUnit = $producto['precioUnit']; 
            $cantidad = $producto['cantidad']; 
            $subTotal = $producto['subTotal'];
            $detalleCompra = $detalleCompraModel->create($compra, $producto_id, $precioUnit, $cantidad, $subTotal);
            $productoModel->updateStock($producto_id, $cantidad);
        }
        $pagoTotal = $detalleCompraModel->getPagoTotal($compra);
        $compraModel->currentPagoTotal($pagoTotal, $compra);
        
    }
    header("Location: ../vista/compraExitosa.php");
}else{
    header("Location: ../Vista/Login.php");
}
