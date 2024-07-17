<?php

session_start();
require_once '../Controlador/ProductoController.php';
$productoControlador = new ProductoControlador();
$productos = $productoControlador->leerProductos();

?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>JaraStore</title>
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>
</head>

<body>
    <?php
    include 'assets/header.php';
    ?>

    <section class="mt-16">

        <p class="w-full text-center py-4 text-3xl font-medium">Productos</p>
        <div class="flex flex-wrap gap-8 px-4 justify-center pb-4">
            <?php if (empty($productos)) : ?>
                <h2>No hay productos registrados</h2>
            <?php else : ?>
                <?php foreach ($productos as $producto) : ?>
                    <div class="flex flex-col gap-y-2 items-center border-solid border-2 border-black px-4 py-2 rounded-xl">
                        <img class="h-12 w-8" src="./public/img-products/<?= $producto['imagen']; ?>" alt="Ropa">
                        <h2 class="font-bold"><?= $producto['nombre']; ?></h2>
                        <p class="self-start"><?= $producto['categoria']; ?></p>
                        <p><?= $producto['precioUnit']; ?></p>
                        <form action="../Controlador/DetalleCompraControlador.php" class="grid grid-cols-3" method="post">
                            <input type="hidden" name="productoId" value="<?= $producto['id']; ?>">
                            <p class="px-2 py-1 cursor-pointer bg-slate-400 rounded-sm text-center" onclick="disminuirInput(<?= $producto['id']; ?>)">-</p>
                            <input class="w-10 text-center" name="cantidad_<?= $producto['id']; ?>" type="number" id="cantidad-<?= $producto['id']; ?>" value="0" readonly>
                            <p class="px-2 py-1 cursor-pointer bg-slate-400 rounded-sm text-center" onclick="aumentarInput(<?= $producto['id']; ?>)">+</p>
                            <button class="col-span-3 my-2 bg-zinc-700 text-white rounded-sm">Añadir al carrito</button>
                        </form>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
    <?php include 'assets/footer.php'; ?>
</body>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    function disminuirInput(id) {
        const inputCantidad = document.getElementById(`cantidad-${id}`);
        let cantidad = parseInt(inputCantidad.value, 10);
        if (!isNaN(cantidad) && cantidad > 0) {
            inputCantidad.value = cantidad - 1;
        }
    }

    function aumentarInput(id) {
        const inputCantidad = document.getElementById(`cantidad-${id}`);
        let cantidad = parseInt(inputCantidad.value, 10);
        if (!isNaN(cantidad)) {
            inputCantidad.value = cantidad + 1;
        }
    }
</script>

</html>