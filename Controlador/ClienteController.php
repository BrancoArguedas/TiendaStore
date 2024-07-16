<?php

require_once 'Conexion.php';
require_once '../Modelo/ClienteModelo.php';

class ClienteController
{
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new Cliente();
    }

    public function Request()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'update':
                $this->editarCliente();
                break;
            case 'delete':
                $this->eliminarCliente();
                break;
        }
    }

    public function editarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['editar_cliente_id'];
            $nombre = $_POST['nombreCliente'];
            $apodo = $_POST['apodoCliente'];
            $direccion = $_POST['direccionCliente'];
            $ciudad = $_POST['ciudadCliente'];
            $codPostal = $_POST['codPostalCliente'];
            $pais = $_POST['paisCliente'];
            $resultado = $this->clienteModel->update($id, $nombre, $apodo, $direccion, $ciudad, $codPostal, $pais);
      
            if ($resultado === true) {
                header("Location: ../Vista/Dashboard.php");
                exit(); 
            } elseif ($resultado === null) {
                echo 'No se realizaron cambios';
            } else {
                echo 'Error al editar el cliente';
            }
        }
    }

    public function eliminarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente_id = $_POST['eliminar_cliente_id'];
            $resultado = $this->clienteModel->delete($cliente_id);
            if ($resultado) {
                header("Location: ../vista/Dashboard.php");
                exit(); 
            } else {
                echo 'Error al eliminar el cliente';
            }
        }
        
    }

    public function leerCliente()
    {
        $productos = $this->clienteModel->read();
        return $productos;
    }
}

$controller = new ClienteController();
$controller->Request();
