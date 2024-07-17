<?php

require_once 'Conexion.php';
require_once '../Modelo/ProductoModelo.php';

class ProductoControlador
{
    private $productoModel;

    public function __construct()
    {
        $this->productoModel = new Producto();
    }

    public function Request()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'create':
                $this->crearProducto();
                break;
            case 'update':
                $this->editarProducto();
                break;
            case 'delete':
                $this->eliminarProducto();
                break;
            case 'read':
                $this->leerProductos();
                break;
        }
    }
    public function crearProducto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $creado = date("Y-m-d H:i:s");
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
                $destination = "../vista/public/img-products/" . $filename;

                $i++;
            }

            if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $destination)) {

                exit("Can't move uploaded file");
            }
            $resultado = $this->productoModel->create( $descripcion, $categoria, $precio, $filename, $stock, $creado );
            if( $resultado ){
                header('Location: ../Vista/Dashboard.php');
                exit();
            }else{
                echo 'error al crear prodcuto';
            }
        }
    }

    public function editarProducto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['categoria_id'];
            $nombre = $_POST['nombre'];
            $categoria_id = $_POST['categoria_id'];
            $precioUnit = $_POST['precioUnit'];
            $imagen = $_POST['imagen'];
            $stock = $_POST['stock'];
            echo $this->productoModel->update($id, $nombre, $categoria_id, $precioUnit, $imagen, $stock) ? 'Edición exitosa' : 'Edición fallida';
        }
    }

    public function eliminarProducto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto_id = $_POST['eliminar_producto_id'];
            $resultado = $this->productoModel->delete($producto_id);
            if ($resultado) {
                header("Location: ../vista/Dashboard.php");
                exit(); 
            } else {
                echo 'Error al eliminar el cliente';
            }
        }
        
    }

    public function leerProductos()
    {
        $productos = $this->productoModel->read();
        return $productos;
    }

    public function obtenerProductoById($id){
        return $this->productoModel->getProductById($id);
    }
}

$controller = new ProductoControlador();
$controller->Request();
