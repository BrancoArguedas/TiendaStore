<?php

require_once '../Modelo/ClienteModelo.php';
require_once '../Modelo/UsuarioModelo.php';

if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = "cliente";
    $nombre = $_POST['nombre'];
    $apodo = $_POST['userName'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $codPostal = $_POST['codPostal'];
    $pais = $_POST['pais'];
    $creado = date('d-m-Y H:i:s');

    /* Crear y obtener usuario */
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->create($email, $password, $rol, $creado);
    var_dump($usuario);
    $user = $usuarioModel->findUserByEmail($email);
    var_dump($user);
    $user_id = $user['id'];

    /* Crear cliente */
    $clienteModel = new Cliente();
    $cliente = $clienteModel->create($user_id, $nombre, $apodo, $direccion, $ciudad, $codPostal, $pais);

    if($usuario && $cliente){
        header("Location: ../Vista/Index.php");
    }
    else{
        echo "error de registro";
    }
}


?>