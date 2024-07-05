<?php
session_start();

require_once '../Controlador/ProductoController.php';

$productoController = new ProductoControlador(); // Asegúrate de que este es el nombre correcto de la clase

if (isset($_GET['id'])) {
    $producto_id = intval($_GET['id']); 
    $producto = $productoController->getProductoById($producto_id);
}
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
    <?php include 'assets/header.php'; ?>
    <main class="flex w-full mt-10 items-center">
        <div class="w-1/2">
            <img src="public/img-products/<?= htmlspecialchars($producto['imagen'])?>" alt="Foto-producto">
        </div>
        <div class="w-1/2 flex flex-col justify-center gap-8">
            <h2 class="text-3xl text-center"><?php echo htmlspecialchars($producto['descripcion']); ?></h2>
            <form class="w-1/2 grid grid-cols-2 gap-y-8" action="../Controlador/CompraController.php" method="post">
                <input type="hidden" value="<?= htmlspecialchars($producto_id) ?>" name="producto_id">
                <label>Categoría:</label>
                <input type="text" name="categoria" placeholder="<?= htmlspecialchars($producto['categoria']) ?>" value="<?= htmlspecialchars($producto['categoria']) ?>" readonly>

                <label>Precio:</label>
                <input type="text" id="precio" name="precioUnit" placeholder="<?= htmlspecialchars($producto['precio']) ?>" value="<?= htmlspecialchars($producto['precio']) ?>" readonly>

                <label class="flex items-center" for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" min="1" value="1" class="border p-2 w-20" onchange="actualizarSubtotal()">

                <label>Subtotal:</label>
                <input type="text" id="subtotal" name="subTotal" placeholder="<?= htmlspecialchars($producto['precio']) ?>" value="<?= htmlspecialchars($producto['precio']) ?>" readonly>
                <button type="submit" class="py-2 col-span-2 self-center bg-[#FDE68A] rounded-xl">COMPRAR</button>
            </form>
        </div>
    </main>
    <script>
        function actualizarSubtotal() {
            var precio = parseFloat(document.getElementById('precio').value);
            var cantidad = parseInt(document.getElementById('cantidad').value);
            var subtotal = precio * cantidad;
            document.getElementById('subtotal').value = subtotal.toFixed(2);
        }
    </script>
</body>

</html>
