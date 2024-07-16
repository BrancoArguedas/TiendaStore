<?php

require_once 'Conexion.php';
require_once '../Modelo/CategoriaModelo.php';

class CategoriaController{
    private $categoriaModel;

    public function __construct(){
        $this->categoriaModel = new Categoria();
    }

    public function Request(){
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        switch ($action){
            case 'create':
                $this->crearCategoria();
                break;
            case 'update':
                $this->editarCategoria($id);
                break;
            case 'delete':
                $this->eliminarCategoria();
                break;
            case 'read':
                $this->leerCategoria();
                break;
        }
    }
    public function crearCategoria(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $descripcion = $_POST['descripcion'];
            $resultado = $this->categoriaModel->create($descripcion);
            if($resultado){
                header("Location: ../Vista/Dashboard.php");
                exit();
            }else{
                echo 'error al crear categoria';
            }
        }
    }

    public function editarCategoria($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['categoria_id'];
            $descripcion = $_POST['descripcion'];
            $resultado = $this->categoriaModel->update($id, $descripcion);
            if($resultado){
                header("Location: ../Vista/Dashboard.php");
                exit();
            }else{
                echo 'error al crear categoria';
            }
        }
    }
    
    public function eliminarCategoria(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['eliminar_categoria_id'];
            $resultado = $this->categoriaModel->delete($id);
            if($resultado){
                header("Location: ../Vista/Dashboard.php");
                exit();
            }else{
                echo 'error al crear categoria';
            }
        }
    }

    public function leerCategoria(){
        $productos = $this->categoriaModel->read();
        return $productos;
    }
}

$controller = new CategoriaController();
$controller->Request();

?>