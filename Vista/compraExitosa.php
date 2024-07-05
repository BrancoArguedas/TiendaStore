<?php

require_once '../Controlador/ClienteController.php';
require_once '../Controlador/ProductoController.php';

session_start();

if (isset($_GET)) {
    $producto_id = $_GET['id'];
}
if (isset($_SESSION)) {
    $email = $_SESSION['email'];
}
$clienteController = new ClienteControlador();
$cliente = $clienteController->obtenerClienteByEmail($email);
$productoController = new ProductoControlador();
$producto = $productoController->getProductoById($producto_id);

?>
<script src="https://cdn.tailwindcss.com"></script>

<div class="w-full h-screen flex flex-col items-center justify-center">
    <section class="drop-shadow-xl rounded-md flex flex-col gap-8">
        <span class="w-full text-center"><ion-icon class="text-green-700 w-16 h-16" name="checkmark-circle-outline"></ion-icon></span>
        <p class="text-green-700 text-xl">Compra realizada exitosamente</p>
        <div class="flex gap-4">
            <p>Cliente: </p>
            <p><?= $cliente['nombre'] . ' ' . $cliente['apellidoPaterno'] . ' ' . $cliente['apellidoMaterno'] ?></p>
        </div>
        <div class="flex gap-4">
            <p>Producto: </p>
            <p><?= $producto['descripcion'] ?></p>
        </div>
        <div class="flex gap-4">
            <p>Precio:</p>
            <p><?= $producto['precio'] ?></p>
        </div>
        <a class="underline text-green-500" href="Index.php">Seguir comprando</a>
    </section>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
