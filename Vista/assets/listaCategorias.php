<?php
require_once '../Controlador/CategoriaControlador.php';
$categoriaControlador = new CategoriaController();
$categorias = $categoriaControlador->leerCategoria();

?>
<div id="listaCategorias" class="toggleDiv px-4 py-2 hidden w-full">
    <h2 class="text-center my-4 text-xl font-medium">Categorías</h2>
    <a href="#" class="rounded-xl border-solid border-2 border-black px-4 py-2" onclick="openModalCategorias(event, 'agregarCategoria', this)">
        Agregar categoría
    </a>
    <table class="w-full ">
        <thead>
            <tr>
                <th class="px-2 py-2">Descripción</th>
                <th class="px-2 py-2"></th>
                <th class="px-2 py-2"></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($categorias) : ?>
                <?php foreach ($categorias as $categoria) : ?>
                    <tr>
                        <td class="text-center text-sm"><?= $categoria['descripcion'] ?></td>
                        <td class="text-center">
                            <a href="#" data-id="<?= $categoria['id'] ?>" onclick="openModalCategorias(event, 'editarCategoria', this)">
                                <ion-icon class="text-green-500 font-bold" name="create-outline"></ion-icon>
                            </a>
                        </td>
                        <td class="text-center py-4">
                            <a href="#" data-id="<?= $categoria['id'] ?>" onclick="openModalCategorias(event, 'eliminarCategoria', this)">
                                <ion-icon class="text-red-800" name="trash-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="1" class="text-center">NO HAY CATEGORÍAS REGISTRADOS</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php
include './assets/categoriaModals/agregarCategoria.php';
include './assets/categoriaModals/eliminarCategoria.php';
include './assets/categoriaModals/editarCategoria.php';
?>
<script>
    let currentCategoriaId = '';

    function openModalCategorias(event, id, element) {
        event.preventDefault();
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('block');

        currentCategoriaId = element.getAttribute('data-id');
        console.log('Cliente ID:', currentCategoriaId);

        if (id === 'editarCategoria') {
            document.getElementById('editar_categoria_id').value = currentCategoriaId;
        } else if (id === 'eliminarCategoria') {
            document.getElementById('eliminar_categoria_id').value = currentCategoriaId;
        }
    }
</script>