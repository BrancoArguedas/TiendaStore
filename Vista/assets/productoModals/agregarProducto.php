<?php
require_once '../Controlador/CategoriaControlador.php';
$categoriaControlador = new CategoriaController();
$categorias = $categoriaControlador->leerCategoria();

?>

<div id="agregarProducto" class="absolute hidden z-10 bg-white">
    <div class="relative rounded-[0.5rem] grid place-items-center gap-2 px-4  border-solid border-[1px] border-black">
        <header class="flex items-center">
            <h2 class="text-center w-full font-bold">Agregar producto</h2>
            <p onclick="closeModal('agregarProducto')" class="cursor-pointer absolute top-0 right-0 rounded-tr-[0.5rem] px-2 bg-red-500 hover:bg-red-600">x</a>
        </header>
        <form class="grid grid-cols-2 gap-y-8 px-8 py-8" action="../Controlador/ProductoController.php?action=create" enctype="multipart/form-data" method="post">

            <label for="">Descripcion:</label>
            <input name="descripcion" class="border-solid border-2 border-black" type="text">


            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria">
                <option disabled selected>-- Seleccione una categoría --</option>
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?= htmlspecialchars($categoria['id']) ?>"><?= htmlspecialchars($categoria['descripcion']) ?></option>
                <?php endforeach; ?>
            </select>



            <label for="">Precio:</label>
            <input name="precio" step="0.01" class="border-solid border-2 border-black" type="number" name="" id="">


            <label for="">Stock:</label>
            <input name="stock" class="border-solid border-2 border-black" type="number">


            <label for="">Imagen:</label>
            <input name="imagen" class="border-solid border-2 border-black" type="file">

            <button class="bg-amber-200 px-4 py-2 rounded-xl col-span-2 w-1/2 place-self-center">Agregar producto</button>
        </form>
    </div>
</div>