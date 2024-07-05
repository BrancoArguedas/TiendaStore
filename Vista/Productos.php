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
    <title>JaraStore</title>
</head>

<body>
    <?php
        include 'assets/header.php';
    ?>
    <p class="text-center my-8 text-3xl font-medium">Productos</p>
    <main class="w-full flex flex-wrap px-8 gap-8 mb-8">
    <?php
    if (empty($productos)) {
        echo "No hay productos registrados";
    } else {
        foreach ($productos as $producto) {
            echo '<a href="productoInfo.php?id='.$producto['id'].'" class="flex flex-col gap-4 rounded-md items-center border-solid border-2 border-black cursor-pointer w-48">';
            echo '<img src=./public/img-products/' . htmlspecialchars($producto['imagen']) . ' class="h-48 w-full object-cover rounded-t-md" alt="Foto-producto">';
            echo '<p class="font-bold">'. htmlspecialchars($producto['descripcion']) . '</p>';
            echo '<p>' . htmlspecialchars($producto['categoria']) . '</p>';
            echo '<p>S/. ' . htmlspecialchars($producto['precio']) . '</p>';
            echo '<p class="py-2 bg-[#FDE68A] w-full text-center rounded-b-md">Más información</p>';
            echo '</a>';
        }
    }
    ?>
    </main>
    <?php include 'assets/footer.php'; ?>
</body>

</html>