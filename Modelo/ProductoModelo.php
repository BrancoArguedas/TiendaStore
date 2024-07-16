<?php

require_once '../Controlador/Conexion.php';

class Producto{
    private $conn;

    
    public function __construct(){
        $db = new Conexion();
        $this->conn = $db->getConnection();
    }    

    public function create( $nombre, $categoria_id, $precioUnit, $imagen, $stock, $creado ){
        
        try{
            $stmt = $this->conn->prepare("Insert into productos (nombre, categoria_id, precioUnit, imagen, stock, creado) values (:nombre, :categoria_id, :precioUnit, :imagen, :stock, :creado)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':categoria_id', $categoria_id);
            $stmt->bindParam(':precioUnit', $precioUnit);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':creado', $creado);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al guardar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function read(){
        $productos = [];
        try{
            $consulta = $this->conn->query("Select p.id, p.nombre, c.descripcion as categoria, p.precioUnit, p.imagen, p.stock, p.creado from productos p inner join categorias c on p.categoria_id = c.id");
            while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
                $productos[] = $row;
            }
        }catch (PDOException $e){
            echo "Error de la consulta: " . $e->getMessage();
        }
        return $productos;
    }

    public function update( $id, $nombre, $categoria_id, $precioUnit, $imagen, $stock ){
        try{
            $stmt = $this->conn->prepare("Update productos set nombre = :nombre, categoria_id = :categoria_id, precioUnit = :precioUnit, imagen = :imagen, stock = :stock, where id = :id");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':categoria_id', $categoria_id);
            $stmt->bindParam(':precioUnit', $precioUnit);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al editar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id){
        try{
            $stmt = $this->conn->prepare("Delete from productos where id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al eliminar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function getProductByName($nombre) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM productos WHERE nombre = :nombre");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return null;
        }
    }

    public function updateStock($id, $cantidad) {
        $query = "UPDATE productos SET stock = stock - :cantidad WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
}

?>