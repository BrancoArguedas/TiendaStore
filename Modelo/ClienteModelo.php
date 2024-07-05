<?php

require_once 'UsuarioModelo.php';

class Cliente {
    private $conn;

    public function __construct()
    {
        $db = new Conexion;
        $this->conn = $db->getConnection();
    }

    public function create($usuario_id, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $departamento, $provincia, $distrito, $direccion){
        try{
            $consulta = $this->conn->prepare("INSERT INTO clientes (usuario_id, nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, sexo, departamento, provincia, distrito, direccion) VALUES (:usuario_id, :nombre, :apellidoPaterno, :apellidoMaterno, :fechaNacimiento, :sexo, :departamento, :provincia, :distrito, :direccion)");
            $consulta->bindParam(':usuario_id', $usuario_id);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':apellidoPaterno', $apellidoPaterno);
            $consulta->bindParam(':apellidoMaterno', $apellidoMaterno);
            $consulta->bindParam(':fechaNacimiento', $fechaNacimiento);
            $consulta->bindParam(':sexo', $sexo);
            $consulta->bindParam(':departamento', $departamento);
            $consulta->bindParam(':provincia', $provincia);
            $consulta->bindParam(':distrito', $distrito);
            $consulta->bindParam(':direccion', $direccion);

            $consulta->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function getAllClientes() {
        $clientes = [];
        try {
            $consulta = $this->conn->prepare("SELECT c.*, u.* FROM clientes c INNER JOIN usuarios u ON u.id = c.usuario_id");
            $consulta->execute();
            $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $clientes;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function getClienteByEmail($email){
        $cliente = null;
        try {
            $consulta = $this->conn->prepare("SELECT c.id as cliente_id, c.nombre, c.apellidoPaterno, c.apellidoMaterno, c.fechaNacimiento, c.sexo, c.departamento, c.provincia, c.distrito, c.direccion, u.id as usuario_id, u.email, u.password, u.rol  FROM clientes c INNER JOIN usuarios u ON u.id = c.usuario_id where u.email = :email");
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