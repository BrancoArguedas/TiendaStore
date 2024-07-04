<?php

require_once '../Controlador/ProductoController.php';

$productoController = new ProductoControlador();

$productos = $productoController->read();

/* Si $productos está vacío retorna false */

?>

<div class="w-full hidden" id="listaProductos">
    <h2 class="text-center font-medium text-xl my-8">Listado de productos</h2>
    <table class="w-[90%] ">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($productos) :?>
            <?php foreach($productos as $producto): ?>
            <tr class="text-center">
                <td><?=$producto['descripcion']?></td>
                <td><?=$producto['categoria']?></td>
                <td><?=$producto['precio']?></td>
                <td><?=$producto['stock']?></td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td>No hay productos registrados</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>