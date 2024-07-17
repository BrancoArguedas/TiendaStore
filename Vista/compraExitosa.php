<?php

require_once '../Controlador/ClienteController.php';
require_once '../Controlador/ProductoController.php';


session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $clienteController = new ClienteController();
    $cliente = $clienteController->obtenerClienteByEmail($email);
    $productoController = new ProductoControlador();

?>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="w-full h-screen flex flex-col items-center justify-center">
        <section class="drop-shadow-xl rounded-md flex flex-col gap-8">
            <span class="w-full text-center"><ion-icon class="text-green-700 w-16 h-16" name="checkmark-circle-outline"></ion-icon></span>
            <p class="text-green-700 text-xl">Compra realizada exitosamente</p>
            <div class="flex gap-4">
                <p>Cliente: </p>
                <p><?= $cliente['nombre']; ?></p>
            </div>
            <div class="flex gap-4">
                <p>Username: </p>
                <p><?= $cliente['apodo'] ?></p>
            </div>
            <table class="mt-16">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['carrito'])) : ?>
                        <?php foreach ($_SESSION['carrito'] as $indice => $producto) : ?>
                            <tr>
                                <td><?= $producto['producto_id']; ?></td>
                                <td><?= $producto['precioUnit']; ?></td>
                                <td><?= $producto['cantidad']; ?></td>
                                <td><?= $producto['subTotal']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    
                    <?php endif; ?>

                </tbody>
            </table>
            <a class="underline text-green-500" href="Index.php">Seguir comprando</a>
        </section>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<?php } else {
    header("Location: Login.php");
}
