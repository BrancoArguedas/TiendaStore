<?php
require_once '../Controlador/CategoriaControlador.php';
$categoriaControlador = new CategoriaController();
$categorias = $categoriaControlador->leerCategoria();

?>

<div class="absolute hidden z-10 bg-white" id="editarProducto">
    <div class="relative rounded-[0.5rem] grid place-items-center gap-2 px-4  border-solid border-[1px] border-black">
        <header class="flex items-center">
            <h2 class="text-center w-full font-bold">Editar</h2>
            <p onclick="closeModal('editarProducto')" class="cursor-pointer absolute top-0 right-0 rounded-tr-[0.5rem] px-2 bg-red-500 hover:bg-red-600">x</a>
        </header>
        <form class="grid gap-y-2" action="../Controlador/ProductoController.php?action=update" method="POST">
            <input type="hidden" name="producto_id" id="editar_producto_id">
            <label for="nombre">Nombre
                <input type="text" name="nombre" id="nombre">
            </label>
            <label for="categoria">Categoria
                <select name="categoria" id="">
                    <?php foreach($categorias as $categoria): ?>
                    <option value="<?= $categoria['id']?>"><?= $categoria['descripcion']?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label for="direccion">Precio unitario
                <input type="text" step="0.01" name="direccion" id="direccion">
            </label>
            <label for="ciudad">Imagen
                <input type="text" name="ciudad" id="ciudad">
            </label>
            <label for="codPostal">Stock
                <input type="number" name="codPostal" id="codPostal">
            </label>
            
            <button>Editar</button>
        </form>
    </div>
</div>
