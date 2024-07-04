<?php

require_once 'ProductoController.php';

if ($_POST) {
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    if (empty($_FILES)) {
        exit('$_FILES is empty - is file_uploads set to "Off" in php.ini?');
    }
    if ($_FILES["imagen"]["error"] !== UPLOAD_ERR_OK) {

        switch ($_FILES["image"]["error"]) {
            case UPLOAD_ERR_PARTIAL:
                exit('File only partially uploaded');
                break;
            case UPLOAD_ERR_NO_FILE:
                exit('No file was uploaded');
                break;
            case UPLOAD_ERR_EXTENSION:
                exit('File upload stopped by a PHP extension');
                break;
            case UPLOAD_ERR_FORM_SIZE:
                exit('File exceeds MAX_FILE_SIZE in the HTML form');
                break;
            case UPLOAD_ERR_INI_SIZE:
                exit('File exceeds upload_max_filesize in php.ini');
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                exit('Temporary folder not found');
                break;
            case UPLOAD_ERR_CANT_WRITE:
                exit('Failed to write file');
                break;
            default:
                exit('Unknown upload error');
                break;
        }
    }
    if ($_FILES["imagen"]["size"] > 3048576) {
        exit('File too large (max 3MB)');
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES["imagen"]["tmp_name"]);

    $mime_types = ["image/gif", "image/png", "image/jpeg"];
    if (!in_array($_FILES["imagen"]["type"], $mime_types)) {
        exit("Invalid file type");
    }
    $pathinfo = pathinfo($_FILES["imagen"]["name"]);

    $base = $pathinfo["filename"];

    $base = preg_replace("/[^\w-]/", "_", $base);

    $filename = $base . "." . $pathinfo["extension"];

    $destination = "../vista/public/img-products/" .  $filename;

    $i = 1;

    while (file_exists($destination)) {

        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = "../vista/public/img-products" . $filename;

        $i++;
    }

    if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $destination)) {

        exit("Can't move uploaded file");
    }

    $productoControlador = new ProductoControlador();
    $producto = $productoControlador->create($descripcion, $categoria, $precio, $stock, $filename);
    if($producto){
        var_dump($filname);
        header("Location: ../Vista/Dashboard.php");
    }else{
        echo "error al subir la foto";
    }
}

