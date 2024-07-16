<?php
session_start();

require_once '../Controlador/ProductoController.php';

$productoController = new ProductoControlador();

$productos = $productoController->leerProductos();

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

        <main class="h-[calc(100vh-4rem)] flex items-center relative mt-16 gap-16 mx-20">
            <?php include './assets/menuDashboard.php'; ?>
            <div id="contenido" class="flex items-center justify-center border-solid border-black border-[1px] flex-1">
                <?php include './assets/listaClientes.php'; ?>
                <?php include './assets/listaProductos.php'; ?>
                <?php include './assets/listaCategorias.php'; ?>
            </div>
        </main>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script>
            function toggleDiv(divId) {
                var div = document.getElementById(divId);
                var divs = document.querySelectorAll('.toggleDiv');

                divs.forEach(function(el) {
                    if (el === div) {
                        el.style.display = 'block';
                    } else {
                        el.style.display = 'none';
                    }
                });
            }

            function closeModal(id) {
                const modal = document.getElementById(id);
                modal.classList.remove('block');
                modal.classList.add('hidden');
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