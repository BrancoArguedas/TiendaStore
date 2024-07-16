<?php

require_once '../Controlador/Conexion.php';

class Compra{
    private $conn;

    public function __construct(){
        $db = new Conexion;
        $this->conn = $db->getConnection();
    }

    public function create($cliente_id, $precioTotal, $fechaCompra){
        try{
            $stmt = $this->conn->prepare("Insert into compras (cliente_id, precioTotal, fechaCompra) values (:cliente_id, :precioTotal, :fechaCompra)");

            $stmt->bindParam(':cliente_id', $cliente_id);
            $stmt->bindParam(':precioTotal', $precioTotal);
            $stmt->bindParam(':fechaCompra', $fechaCompra);
            return $stmt->execute();
        }catch (PDOException $e){
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function read(){
        $compras = [];
        try {
            $consulta = $this->conn->query("Select * from compras");
            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $compras[] = $row;
            }
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
        }
        return $compras;
    }

    public function delete($id){
        try{
            $stmt = $this->conn->prepare("Delete from compras where id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al editar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function currentPagoTotal($pagoTotal, $compra_id){
        try{
            $stmt = $this->conn->prepare("update compras set precioTotal = :pagoTotal where compra_id = :compra_id");
            $stmt->bindParam(':pagoTotal', $pagoTotal);
            $stmt->bindParam(':compra_id', $compra_id);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al editar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function getUltimaCompra(){
        return $this->conn->lastInsertId();
    }

    public function getCompraById(){
        $id = $this->getUltimaCompra();
        try{
            $stmt = $this->conn->prepare("select * from compras where compra_id = :compra_id");
            $stmt->bindParam(':compra_id', $id);
            $stmt->execute();
            $compra = $stmt->fetch(PDO::FETCH_ASSOC);
            return $compra;
        }catch (PDOException $e){
            echo "Error al editar el producto: " . $e->getMessage();
            return false;
        }
    }

}


?>