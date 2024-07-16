<?php

require_once '../Controlador/Conexion.php';

class Usuario
{
    private $conn;


    public function __construct()
    {
        $db = new Conexion;
        $this->conn = $db->getConnection();
    }

    public function create($email, $password, $rol, $creado){
        try{
            $passwordHasheado = password_hash($password, PASSWORD_BCRYPT);
            $consulta = $this->conn->prepare("INSERT INTO usuarios (email, password, rol, creado) VALUES (:email, :password, :rol, :creado)");
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':password', $passwordHasheado);
            $consulta->bindParam(':rol', $rol);
            $consulta->bindParam(':creado', $creado);
            $consulta->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function read(){
        $usuarios = [];
        try {
            $consulta = $this->conn->query("Select * from usuarios");
            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $usuarios[] = $row;
            }
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
        }
        return $usuarios;
    }

    public function update($id, $email, $password, $modificado){
        try{
            $stmt = $this->conn->prepare("Update usuarios set email = :email, password = :password, modificado = :modificado where id = :id");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':modificado', $modificado);
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
            $stmt = $this->conn->prepare("Delete from usuarios where id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo "Error al editar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function validarDatos($email, $password){
        try {
            $consulta = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC); 
            if ($usuario) {
                
                if (password_verify( $password, $usuario['password'] )) {
                    
                    return $usuario; 
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }
    
    public function findUserByEmail($email) {
        try {
            $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return null;
        }
    }

    public function findUserById($id){

        try {
            $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $user = $stmt->fetch();
            return $user;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return null;
        }
    }

    
}
