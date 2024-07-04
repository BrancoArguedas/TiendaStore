<?php

require_once 'Conexion.php';
require_once '../Modelo/ProductoModelo.php';



class ProductoControlador{

    private $productoModel;

    public function __construct() {
        $db = new Conexion();
        $this->productoModel = new Producto($db);
    }


    /* create($_POST['descripcion'], */
    public function create($descripcion, $categoria, $precio, $stock, $imagen){
        return $this->productoModel->crearProducto($descripcion, $categoria, $precio, $stock, $imagen);
    }

    public function read(){
        return $this->productoModel->getAllProductos();
    }

    public function update($id, $descripcion, $categoria, $precio, $stock, $imagen){
        return $this->productoModel->editarProducto($id, $descripcion, $categoria, $precio, $stock, $imagen);
    }

    public function delete($id){
        return $this->productoModel->eliminarProducto($id);
    }
    
    public function getProductoById($id){
        return $this->productoModel->obtenerProductoId($id);
    }

    public function actualStock($id, $cantidad){
        return $this->productoModel->actualizarStock($id, $cantidad);
    }
}

?>