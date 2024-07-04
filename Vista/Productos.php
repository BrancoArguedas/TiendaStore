<?php

session_start();

require_once '../Controlador/ProductoController.php';
$productoControlador = new ProductoControlador();
$productos = $productoControlador->read();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <?php
        include 'assets/header.php';
    ?>
    <p class="text-center my-8 text-3xl font-medium">Productos</p>
    <main class="w-full grid grid-cols-4 px-8 gap-8 mb-8">
    <?php
    if (empty($productos)) {
        echo "No hay productos registrados";
    } else {
        foreach ($productos as $producto) {
            echo '<a href="productoInfo.php?id='.$producto['id'].'" class="flex flex-col gap-4 py-4 rounded-xl items-center border-solid border-2 border-black cursor-pointer">';
            echo '<p>Descripción: '. $producto['descripcion'] . '</p>';
            echo '<p>Categoría: ' . $producto['categoria'] . '</p>';
            echo '<p>Precio: ' . $producto['precio'] . '</p>';
            echo '<p>Stock: ' . $producto['stock'] . '</p>';
            echo '</a>';
        }
    }
    ?>
    </main>
    <?php include 'assets/footer.php'; ?>
</body>

</html>