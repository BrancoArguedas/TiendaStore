<?php

require_once '../Controlador/Conexion.php';

class Categoria{

    private $conn;
    
    public function __construct(){
        $db = new Conexion();
        $this->conn = $db->getConnection();
    }

    public function create($descripcion){
        try{
            $stmt = $this->conn->prepare("Insert into categorias (descripcion) values (:descripcion)");
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function read(){
        $categorias = [];
        try {
            $consulta = $this->conn->prepare("SELECT * FROM categorias");
            $consulta->execute();
            $categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $categorias;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $descripcion){
        try{
            $stmt = $this->conn->prepare("Update categorias set descripcion = :descripcion where id = :id");
            $stmt->bindParam(":descripcion", $descripcion);
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
            $stmt = $this->conn->prepare("Delete from categorias where id = :id");
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
