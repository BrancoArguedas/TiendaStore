<?php

require_once 'Conexion.php';
require_once '../Modelo/ClienteModelo.php';



class ClienteControlador{

    private $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
    }


    /* create($_POST['descripcion'], */
    public function create($usuario_id, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $departamento, $provincia, $distrito, $direccion){
        return $this->clienteModel->crearCliente($usuario_id, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $departamento, $provincia, $distrito, $direccion);
    }

    public function read(){
        return $this->clienteModel->getAllProductos();
    }
/*
    public function update($id, $descripcion, $categoria, $precio, $stock, $imagen){
        return $this->clienteModel->editarProducto($id, $descripcion, $categoria, $precio, $stock, $imagen);
    }

    public function delete($id){
        return $this->clienteModel->eliminarProducto($id);
    }
    */
    public function obtenerClienteByEmail($email){
        return $this->clienteModel->getClienteByEmail($email);
    }

    public function obtenerClienteById($email){
        return $this->clienteModel->getClienteById($email);
    }

}

?>