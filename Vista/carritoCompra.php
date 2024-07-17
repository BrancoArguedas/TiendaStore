<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>JaritaStore</title>
</head>

<body>
    <?php
    include 'assets/header.php';
    ?>
    <table class="mt-16">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
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
                        <td>
                            <a href="eliminar_producto.php?indice=<?= $indice; ?>">
                                <ion-icon class="text-red-800" name="trash-outline"></ion-icon>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No hay productos en el carrito</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
    <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) : ?>
        <form action="../Controlador/CompraController.php" method="post">
            <button type="submit" name="comprarTodo" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Comprar Todo</button>
        </form>
    <?php endif; ?>

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>