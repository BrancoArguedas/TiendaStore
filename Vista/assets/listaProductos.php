<?php
require_once '../Controlador/ProductoController.php';
$productoControlador = new ProductoControlador();
$productos = $productoControlador->leerProductos();

?>

<div id="listaProductos" class="toggleDiv px-4 py-2 hidden w-full">
    <h2 class="text-center my-4 text-xl font-medium">Productos</h2>
    <a href="#" class="rounded-xl border-solid border-2 border-black px-4 py-1 my-2" onclick="openModalProductos(event, 'agregarProducto', this)">
        Agregar producto
    </a>
    <table class="w-full ">
        <thead>
            <tr>
                <th class="px-2 py-2">Descripción</th>
                <th class="px-2 py-2">Categoria</th>
                <th class="px-8 py-2">Precio unitario</th>
                <th class="px-2 py-2">Imagen</th>
                <th class="px-2 py-2">Stock</th>
                <th class="px-2 py-2">Creado</th>
                <th class="px-2 py-2"></th>
                <th class="px-2 py-2"></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($productos) : ?>
                
                <?php foreach ($productos as $producto) : ?>
                    <tr>
                        <td class="text-center text-sm"><?= $producto['nombre'] ?></td>
                        <td class="text-center text-sm"><?= $producto['categoria'] ?></td>
                        <td class="text-center text-sm"><?= $producto['precioUnit'] ?></td>
                        <td class="text-center text-sm"><img class="h-12 w-12 object-cover mx-auto" src="./public/img-products/<?= $producto['imagen']?>" alt="Ropa"></td>
                        <td class="text-center text-sm"><?= $producto['stock'] ?></td>
                        <td class="text-center text-sm"><?= $producto['creado'] ?></td>
                        <td class="text-center">
                            <a href="#" data-id="<?= htmlspecialchars($producto['id']) ?>" onclick="openModalProductos(event, 'editarProducto', this)">
                                <ion-icon class="text-green-500 font-bold" name="create-outline"></ion-icon>
                            </a>
                        </td>
                        <td class="text-center py-4">
                            <a href="#" data-id="<?= htmlspecialchars($producto['id']) ?>" onclick="openModalProductos(event, 'eliminarProducto', this)">
                                <ion-icon class="text-red-800" name="trash-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">NO HAY PRODUCTOS REGISTRADOS</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php
include './assets/productoModals/agregarProducto.php';
include './assets/productoModals/eliminarProducto.php';
include './assets/productoModals/editarProducto.php';
?>
<script>
    let currentProductoId = '';

    function openModalProductos(event, id, element) {
        event.preventDefault();
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('block');

        currentProductoId = element.getAttribute('data-id');
        console.log('Cliente ID:', currentProductoId);

        if (id === 'editarProducto') {
            document.getElementById('editar_producto_id').value = currentProductoId;
        } else if (id === 'eliminarProducto') {
            document.getElementById('eliminar_producto_id').value = currentProductoId;
        }
    }
</script>