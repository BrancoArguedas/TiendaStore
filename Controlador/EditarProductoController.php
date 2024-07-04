<?php

require_once 'ProductoController.php';
if ($_POST) {
    $productoController = new ProductoControlador();

    $producto_id = $_POST['producto_id']; // Asignar el ID del producto
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $target_dir = "../Vista/public/img-products/";
    $target_file = "";

    // Verificar y mover la imagen si se ha subido
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $target_file = $target_dir . basename($_FILES['imagen']["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            echo "El archivo es una imagen - " . $check["mime"] . ".";
        } else {
            echo "El archivo no es una imagen.";
            exit; // Salir si no es una imagen
        }

        if (file_exists($target_file)) {
            echo "Lo siento, el archivo ya existe.";
            exit; // Salir si el archivo ya existe
        }

        if ($_FILES["imagen"]["size"] > 50000000) {
            echo "Lo siento, tu archivo es demasiado grande.";
            exit; // Salir si el archivo es demasiado grande
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit; // Salir si el archivo no es una imagen válida
        }

        // Mover la imagen al directorio destino
        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            echo "Lo siento, hubo un error al subir tu archivo.";
            exit; // Salir si hay un error al mover el archivo
        }
    }

    // Actualizar el producto
    $productoActualizado = $productoController->update($producto_id, $descripcion, $categoria, $precio, $stock, $target_file);

    if ($productoActualizado) {
        header("Location: ../Vista/Dashboard.php");
        exit;
    } else {
        echo 'Error al actualizar el producto';
    }
}
