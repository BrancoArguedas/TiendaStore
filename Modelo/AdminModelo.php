<?php

require_once '../Controlador/Conexion.php';

class Admin{

    private $conn;
    
    public function __construct(){
        $db = new Conexion();
        $this->conn = $db->getConnection();
    }

    public function create($usuario_id, $nombre, $creado){
        try{
            $stmt = $this->conn->prepare("Insert into admins (usuario_id, nombre, creado) values (:usuario_id, :nombre, :creado)");
            $stmt->bindParam(":usuario_id", $usuario_id);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":creado", $creado);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function read(){
        $admins = [];
        try {
            $consulta = $this->conn->prepare("SELECT * FROM admins");
            $consulta->execute();
            $admins = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $admins;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $nombre, $modificado){
        try{
            $stmt = $this->conn->prepare("Update categorias set nombre = :nombre, modificado = :modificado  where id = :id");
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":modificado", $modificado);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id){
        try{
            $stmt = $this->conn->prepare("Delete from admins where id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }
}
?>