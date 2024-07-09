<?php

use Symfony\Component\VarDumper\VarDumper;

require_once '../Controlador/Conexion.php';

class Usuario
{
    private $conn;


    public function __construct()
    {
        $db = new Conexion;
        $this->conn = $db->getConnection();
    }

    public function create($email, $password, $rol){
        try{
            $passwordHasheado = password_hash($password, PASSWORD_BCRYPT);
            $consulta = $this->conn->prepare("INSERT INTO usuarios (email, password, rol) VALUES (:email, :password, :rol)");
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':password', $passwordHasheado);
            $consulta->bindParam(':rol', $rol);
            $consulta->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function validarDatos($email, $password){
        try {
            $consulta = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
            var_dump($usuario);
            if ($usuario) {
                // Verifica la contraseña usando password_verify
                if (password_verify( $password, $usuario['password'] )) {
                    
                    return $usuario; // Retorna los datos del usuario si las credenciales son correctas
                } else {
                    var_dump($password);
                    var_dump($usuario['password']);
                    return false; // Retorna false si las credenciales son incorrectas
                }
            } else {
                return false; // Retorna false si no se encontró ningún usuario con ese correo
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }
    
    public function findUserByEmail($email){

        try {
            $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Verifica si se encontró un usuario
            if ($user === false) {
                return null; // No se encontró ningún usuario con ese correo
            }

            return $user; // Devuelve el usuario encontrado
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return null; // Manejo del error: devuelve null en caso de error
        }
    }

    public function findUserById($id){

        try {
            $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE id = ?');
            $stmt->execute([$id]);
            $user = $stmt->fetch();

            // Verifica si se encontró un usuario
            if ($user === false) {
                return null; // No se encontró ningún usuario con ese correo
            }

            return $user; // Devuelve el usuario encontrado
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return null; // Manejo del error: devuelve null en caso de error
        }
    }

    public function readUsuarios()
    {
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
}
