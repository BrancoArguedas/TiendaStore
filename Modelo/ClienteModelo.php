<?php

require_once 'UsuarioModelo.php';
require_once '../Controlador/Conexion.php';

class Cliente {
    private $conn;

    public function __construct(){
        $db = new Conexion;
        $this->conn = $db->getConnection();
    }

    public function create($usuario_id, $nombre, $apodo, $direccion, $ciudad, $codPostal, $pais){
        try{
            $consulta = $this->conn->prepare("INSERT INTO clientes (usuario_id, nombre, apodo, direccion, ciudad, codPostal, pais) VALUES (:usuario_id, :nombre, :apodo, :direccion, :ciudad, :codPostal, :pais)");
            $consulta->bindParam(':usuario_id', $usuario_id);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':apodo', $apodo);
            $consulta->bindParam(':direccion', $direccion);
            $consulta->bindParam(':ciudad', $ciudad);
            $consulta->bindParam(':codPostal', $codPostal);
            $consulta->bindParam(':pais', $pais);

            $consulta->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function read() {
        $clientes = [];
        try {
            $consulta = $this->conn->prepare("SELECT * FROM clientes");
            $consulta->execute();
            $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $clientes;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $nombre, $apodo, $direccion, $ciudad, $codPostal, $pais){
        try{
            $stmt = $this->conn->prepare("Update clientes set nombre = :nombre, apodo = :apodo, direccion = :direccion, ciudad = :ciudad, codPostal = :codPostal, pais = :pais where id = :id");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apodo', $apodo);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':ciudad', $ciudad);
            $stmt->bindParam(':codPostal', $codPostal);
            $stmt->bindParam(':pais', $pais);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al editar el cliente: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id){
        try{
            $stmt = $this->conn->prepare("delete from clientes where id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al editar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function getClienteByEmail($email){
        $cliente = null;
        try {
            $consulta = $this->conn->prepare("SELECT c.*, u.email from clientes c inner join usuarios u on u.id = c.usuario_id  where u.email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            $cliente = $consulta->fetch(PDO::FETCH_ASSOC);
            return $cliente;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

}

?>