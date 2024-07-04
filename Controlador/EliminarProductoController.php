<?php

require_once 'ProductoController.php';

if($_POST){

    $productoController = new ProductoControlador();

    $producto_id = $_POST['producto_id'];

    if($productoController->delete($producto_id)){
        header("Location: ../Vista/Dashboard.php");
    }else{
        echo 'error al eliminar un producto';
    }

}


?>