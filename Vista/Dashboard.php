<?php
session_start();

require_once '../Controlador/ProductoController.php';

$productoController = new ProductoControlador();

$productos = $productoController->read();

if (isset($_SESSION['usuario_id']) && ($_SESSION['rol'] == 'admin')) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>JaraTarea</title>
    </head>

    <body>
        <?php include './assets/header.php'; ?>

        <main class=" flex items-start relative">
            <div id="contenido" class="flex">
                <?php include './assets/menuDashboard.php'; ?>
                <div id="contenedor" class=" h-96 rounded-base">
                    <div class="bg-black text-white w-full flex justify-around">
                        <h2 class="">Productos</h2>
                        <p class="cursor-pointer" onclick="mostrarModal('añadirProducto')">Agregar producto</p>
                    </div>
                    <table class="">
                        <thead>
                            <tr>
                                <th class="px-8 py-4">Descripcion</th>
                                <th class="px-8 py-4">Categoria</th>
                                <th class="px-8 py-4">Precio</th>
                                <th class="px-8 py-4">Stock</th>
                                <th class="px-8 py-4">Imagen</th>
                                <th class="px-8 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($productos) : ?>
                                <?php foreach ($productos as $producto) : ?>
                                    <tr class="text-center">
                                        <td class="py-4"><?= $producto['descripcion'] ?></td>
                                        <td class="py-4"><?= $producto['categoria'] ?></td>
                                        <td class="py-4"><?= $producto['precio'] ?></td>
                                        <td class="py-4"><?= $producto['stock'] ?></td>
                                        <td class="py-4" ><img  src="./public/img-products/<?= $producto['imagen'] ?>" alt="Producto" class="w-8 mx-auto"></td>
                                        <td class="py-4"><a href="Dashboard.php?action=editar&id=<?php echo $producto['id']; ?>" onclick="mostrarModal('editarProducto')"><ion-icon class="text-green-500 font-bold" name="create-outline"></ion-icon></a></td>
                                        <td class="py-4"><a href="Dashboard.php?action=eliminar&id=<?php echo $producto['id']; ?>" onclick="mostrarModal('eliminarProducto')"><ion-icon class="text-red-800" name="trash-outline"></ion-icon></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td>No hay productos registrados</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php include './assets/añadirProductos.php'; ?>
            <?php include './assets/editarProductos.php'; ?>
            <?php include './assets/eliminarProductos.php'; ?>
        </main>


        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script>
            const modalAñadirProducto = document.getElementById('añadirProducto');
            const modalEditarProducto = document.getElementById('editarProducto');
            const modalEliminarProducto = document.getElementById('eliminarProducto');
            const contenido = document.getElementById('contenido');

            function mostrarModal(id){
                contenido.classList.add("blur");

                switch (id){
                    case 'añadirProducto':
                        modalAñadirProducto.classList.remove("hidden");
                        modalAñadirProducto.classList.add("flex");
                        break;
                    case 'editarProducto':
                        modalEditarProducto.classList.remove("hidden");
                        modalEditarProducto.classList.add("flex");
                        break;
                    case 'eliminarProducto':
                        modalEliminarProducto.classList.remove("hidden");
                        modalEliminarProducto.classList.add("flex");
                        break;
                }
                
            }
        </script>
    </body>

    </html>

<?php
} else {
    header("Location: MensajeError.php");
    exit();
}
?>