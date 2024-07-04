<?php

require_once '../Modelo/Usuario.php';

class UsuarioController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    public function crearUsuario()
    {
        if ($_POST) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->usuarioModel->create($email, $password);
            if ($user) {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['rol'] = $user['rol'];
                if ($user['rol'] == "admin") {
                    header("Location: ../Vista/Dashboard.php");
                } else {
                    header("Location: ../Vista/Index.php");
                }
                exit();
            } else {
                header("Location: ../Vista/Login.php?error=1");
                exit();
            }
        }
    }
}
