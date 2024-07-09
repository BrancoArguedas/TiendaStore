<?php

session_start();

require_once '../Controlador/ClienteController.php';

if($_SESSION){
    $cliente_id = $_SESSION['cliente_id'];
    $clienteControlador = new ClienteControlador();

    $cliente = $clienteControlador->obtenerClienteById($cliente_id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jara Store</title>
</head>
<body>
    pagina de mis datos
</body>
</html>