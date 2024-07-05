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
    
    <section class="mt-16">
        <p class="w-full text-center py-4 text-3xl font-medium">Productos</p>
        <div class="flex flex-wrap gap-8 px-4 justify-center pb-4">
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
        </div>
    </section>
    <?php include 'assets/footer.php'; ?>
</body>

</html>