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
            <?php if (empty($productos)): ?>
                <h2>No hay productos registrados</h2>
            <?php else: ?>
                <?php foreach ($productos as $producto): ?>
                    <?php if ($producto['stock'] > 0): ?>
                        <?php if ($producto['stock'] < 10): ?>
                            <!-- Productos con poco stock -->
                            <a href="productoInfo.php?id=<?= $producto['id'] ?>" class="flex flex-col gap-4 rounded-md items-center justify-center border-solid border-2 border-black cursor-pointer w-48 relative overflow-hidden drop-shadow-md">
                                <h2 class="w-full bg-red-600 text-center top-10 -left-10 text-white font-bold absolute -rotate-45">QUEDAN POCOS</h2>
                                <img src="./public/img-products/<?= htmlspecialchars($producto["imagen"])?>" alt="Imagen-producto" class="h-48 w-full object-cover rounded-t-md">
                                <p class="font-bold"><?= htmlspecialchars($producto['descripcion']) ?></p>
                                <p><?= htmlspecialchars($producto['categoria']) ?></p>
                                <p>S/. <?= htmlspecialchars($producto['precio']) ?></p>
                                <p class="py-2 bg-[#FDE68A] w-full text-center rounded-b-md">Más información</p>
                            </a>
                        <?php else: ?>
                            <a href="productoInfo.php?id=<?= $producto['id'] ?>" class="flex flex-col gap-4 rounded-md items-center justify-center border-solid border-2 border-black cursor-pointer w-48 drop-shadow-md">
                                <img src="./public/img-products/<?= htmlspecialchars($producto["imagen"])?>" alt="Imagen-producto" class="h-48 w-full object-cover rounded-t-md">
                                <p class="font-bold"><?= htmlspecialchars($producto['descripcion']) ?></p>
                                <p><?= htmlspecialchars($producto['categoria']) ?></p>
                                <p>S/. <?= htmlspecialchars($producto['precio']) ?></p>
                                <p class="py-2 bg-[#FDE68A] w-full text-center rounded-b-md">Más información</p>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="productoInfo.php?id=<?= $producto['id'] ?>" class="flex flex-col gap-4 rounded-md items-center justify-center border-solid border-2 border-black cursor-pointer w-48 relative drop-shadow-md">
                            <h2 class="w-full py-4 bg-red-600 text-white font-bold absolute text-center z-10">AGOTADO</h2>
                            <img class="grayscale" src="./public/img-products/<?= htmlspecialchars($producto["imagen"])?>" alt="Imagen-producto" class="backdrop-grayscale h-48 w-full object-cover rounded-t-md">
                            <p class="font-bold"><?= htmlspecialchars($producto['descripcion']) ?></p>
                            <p><?= htmlspecialchars($producto['categoria']) ?></p>
                            <p>S/. <?= htmlspecialchars($producto['precio']) ?></p>
                            <p class="py-2 bg-[#FDE68A] w-full text-center rounded-b-md">Más información</p>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
    <?php include 'assets/footer.php'; ?>
</body>

</html>