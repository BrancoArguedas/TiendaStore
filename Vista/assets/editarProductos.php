<?php

require_once '../Controlador/ProductoController.php';

$productoControlador = new ProductoControlador();


?>


<div id="editarProducto" class="w-full h-full items-center justify-center absolute <?php echo (isset($_GET['id']) && $_GET['action'] == "editar") ? 'flex' : 'hidden'; ?>">
    <div class="border-solid border-black border-2 h-auto flex flex-col rounded-xl">
        <a href="Dashboard.php" class="text-white w-8 self-end text-center bg-red-500 rounded-tr-xl">x</a>
        <h2 class="text-center py-4">Editar un producto</h2>

        <form class="grid grid-cols-2 gap-y-8 px-8 py-8" action="../Controlador/EditarProductoController.php" method="post">
            <?php

            if (isset($_GET['id'])) {
                $producto_id = $_GET['id'];
                $producto = $productoControlador->getProductoById($producto_id);
            }

            ?>

            <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
            
            <label for="">Descripcion:</label>
            <input name="descripcion" class="border-solid border-2 border-black" type="text" placeholder="<?php echo $producto['descripcion']; ?>">


            <label for="">Categoría:</label>
            <input name="categoria" class="border-solid border-2 border-black" type="text" placeholder="<?php echo $producto['categoria']; ?>">


            <label for="">Precio:</label>
            <input name="precio" class="border-solid border-2 border-black" type="number" placeholder="<?php echo $producto['precio']; ?>" step="0.01" min="0">


            <label for="">Stock:</label>
            <input name="stock" class="border-solid border-2 border-black" type="number" placeholder="<?php echo $producto['stock']; ?>">


            <label for="">Imagen:</label>
            <input name="imagen" class="border-solid border-2 border-black" type="file" placeholder="<?php echo $producto['imagen']; ?>">

            <button class="bg-amber-200 px-4 py-2 rounded-xl col-span-2 w-1/2 place-self-center">Editar producto</button>
        </form>
    </div>
</div>