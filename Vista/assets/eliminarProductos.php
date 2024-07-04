<?php

require_once '../Controlador/ProductoController.php';

$productoControlador = new ProductoControlador();


?>

<div id="eliminarProducto" class="w-full h-full items-center justify-center absolute <?php echo (isset($_GET['id']) && $_GET['action'] == "eliminar") ? 'flex' : 'hidden'; ?>">
    <div class="border-solid border-black border-2  bg-red-500 text-white h-auto flex flex-col items-center gap-4 rounded-xl px-2 py-4">
        <?php
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        }
        ?>
        <h2>Eliminar producto</h2>
        <p>¿Está seguro que desea eliminar este producto?</p>
        <form action="../Controlador/EliminarProductoController.php" method="post">
            <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
            <button class="bg-red-700 px-4 py-2 w-1/2 rounded-xl">Confirmar</button>
        </form>
    </div>

</div>