<?php

require_once '../Modelo/DetalleCompraModelo.php';
require_once '../Modelo/CompraModelo.php';
require_once '../Modelo/ProductoModelo.php';

$productoModel = new Producto();

session_start();

if ( !isset($_SESSION['cliente_id']) ){
    header("Location: ../Vista/Login.php");
}else{
    if($_POST){
        $cliente_id = $_SESSION['cliente_id'];
        $producto_id = $_POST['productoId'];
        $cantidad = $_POST['cantidad_'.$producto_id];
        $producto = $productoModel->getProductById($producto_id);
        $precioUnit = $producto['precioUnit'];
        $subTotal = $cantidad * $precioUnit;

        if ( !isset($_SESSION['carrito']) ){
            $producto = array(
                'producto_id' => $producto_id,
                'precioUnit' => $precioUnit,
                'cantidad' => $cantidad,
                'subTotal' => $subTotal
            );
            $_SESSION['carrito'][0] = $producto;
        }else{
            $numProductos = count($_SESSION['carrito']);
            $producto = array(
                'producto_id' => $producto_id,
                'precioUnit' => $precioUnit,
                'cantidad' => $cantidad,
                'subTotal' => $subTotal
            );
            $_SESSION['carrito'][$numProductos] = $producto;
        }
        header("Location: ../Vista/Index.php");
    }
}


?>