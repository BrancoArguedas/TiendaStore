<?php
session_start();

require_once '../Modelo/UsuarioModelo.php';
require_once '../Modelo/ClienteModelo.php';

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // No necesitas hashear el password aquí, ya que lo comparamos con el hash guardado en la base de datos
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->validarDatos($email, $password);

    if ($usuario) {
        $user = $usuarioModel->findUserByEmail($email);

        $clienteModel = new Cliente();
        $cliente = $clienteModel->getClientesByEmail($email);
    
        $_SESSION['cliente_id'] = $cliente['id'];
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['rol'] = $user['rol'];

        if ($user['rol'] == "admin") {
            header("Location: ../Vista/Dashboard.php");
            exit(); 
        } elseif ($user['rol'] == "cliente") {
            header("Location: ../Vista/Productos.php");
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
