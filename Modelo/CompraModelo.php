<?php

require_once '../Controlador/Conexion.php';

class Compra{
    private $conn;

    public function __construct(){
        $db = new Conexion;
        $this->conn = $db->getConnection();
    }

    public function create($cliente_id, $producto_id, $cantidad){

        $fechaCompra = date('d-m-Y H:i:s');
        try{
            $stmt = $this->conn->prepare("Insert into ordencompras (cliente_id, producto_id, cantidad, precioTotal, fechaCompra values (:cliente_id, :producto_id, :cantidad, :precioTotal");

            $stmt->bindParam(':cliente_id', $cliente_id);
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precioTotal', $precioTotal);
        }catch (PDOException $e){
            echo "Error de la consulta: " . $e->getMessage();
        }
    }
}


?>