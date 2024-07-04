<?php

class Producto{
    private $conn;

    
    public function __construct($db){
        $this->conn = $db->getConnection();
    }

    public function getAllProductos(){
        $productos = []; /* Listas asociativas */
        try{
            $consulta = $this->conn->query("Select * from Productos");
            while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
                $productos[] = $row;
            }
        }catch (PDOException $e){
            echo "Error de la consulta: " . $e->getMessage();
        }
        return $productos;
    }

    public function crearProducto($descripcion, $categoria, $precio, $stock, $imagen ){
        
        try{
            $stmt = $this->conn->prepare("Insert into productos (descripcion, categoria, precio, stock, imagen) values (:descripcion, :categoria, :precio, :stock, :imagen)");
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->execute();
            header("Location: ../Vista/Dashboard.php");
            return true;
        }catch (PDOException $e){
            echo "Error al guardar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function editarProducto($id, $descripcion, $categoria, $precio, $stock, $imagen ){
        try{
            $stmt = $this->conn->prepare("Update productos set descripcion = :descripcion, categoria = :categoria, precio = :precio, stock = :stock, imagen = :imagen where id = :id");
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al editar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarProducto($id){
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

    public function obtenerProductoId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM productos WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return null;
        }
    }

    public function actualizarStock($id, $cantidad) {
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