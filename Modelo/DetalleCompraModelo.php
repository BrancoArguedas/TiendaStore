<?php

require_once '../Controlador/Conexion.php';

class DetalleCompra{

    private $conn;
    
    public function __construct(){
        $db = new Conexion();
        $this->conn = $db->getConnection();
    }

    public function getPagoTotal($compra_id) {
        try {
            $stmt = $this->conn->prepare("select sum(subTotal) as total_subtotal from detallecompras where compra_id = :compra_id");
            $stmt->bindParam(':compra_id', $compra_id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total_subtotal']; 
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function create($compra_id, $producto_id, $precioUnit, $cantidad, $subTotal){
        try{
            $stmt = $this->conn->prepare("Insert into detallecompras (compra_id, producto_id, precioUnit, cantidad, subTotal) values (:compra_id, :producto_id, :precioUnit, :cantidad, :subTotal)");
            $stmt->bindParam(":compra_id", $compra_id);
            $stmt->bindParam(":producto_id", $producto_id);
            $stmt->bindParam(":precioUnit", $precioUnit);
            $stmt->bindParam(":cantidad", $cantidad);
            $stmt->bindParam(":subTotal", $subTotal);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function read(){
        $detallecompras = [];
        try {
            $consulta = $this->conn->prepare("SELECT * FROM detallecompras");
            $consulta->execute();
            $detallecompras = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $detallecompras;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $de){
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