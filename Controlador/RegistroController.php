<?php

require_once '../Modelo/ClienteModelo.php';
require_once '../Modelo/UsuarioModelo.php';

if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = "cliente";
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $sexo = $_POST['sexo'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $direccion = $_POST['direccion'];

    /* Crear y obtener usuario */
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->create($email, $password, $rol);
    $user = $usuarioModel->findUserByEmail($email);
    $user_id = $user['id'];

    /* Crear cliente */
    $clienteModel = new Cliente();
    $cliente = $clienteModel->create($user_id, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $departamento, $provincia, $distrito, $direccion);

    if($usuario && $cliente){
        header("Location: ../Vista/Index.php");
    }
    else{
        echo "error de registro";
    }
}


?>