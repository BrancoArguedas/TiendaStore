<?php

session_start();

require_once '../Modelo/UsuarioModelo.php';
require_once '../Modelo/ClienteModelo.php';

if ( isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // No necesitas hashear el password aquí, ya que lo comparamos con el hash guardado en la base de datos
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->validarDatos($email, $password);

    if ($usuario) {

        $clienteModel = new Cliente();
        $cliente = $clienteModel->getClienteByEmail($email);
        $_SESSION['cliente_id'] = $cliente['id'];
        $_SESSION['apodo'] = $cliente['apodo'];
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['rol'] = $usuario['rol'];
        
        if ($usuario['rol'] == "admin") {
            header("Location: ../Vista/Dashboard.php");
            exit(); 
        } elseif ($usuario['rol'] == "cliente") {
            header("Location: ../Vista/Index.php");
            exit();
        } else {
            header("Location: ../Vista/Login.php?error=1");
            exit();
        }
    } else {
        header("Location: ../Vista/Login.php?error=2");
        exit();
    }
        
} else {
    header("Location: ../Vista/Index.php");
    exit();
}
?>
