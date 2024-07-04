<div id="añadirProducto" class="w-full h-screen hidden items-center justify-center absolute">
    <div class="border-solid border-black border-2 h-auto flex flex-col rounded-xl">
        <a href="Dashboard.php" class="text-white w-8 self-end text-center bg-red-500 rounded-tr-xl">x</a>
        <h2 class="text-center py-4">Agregar un producto</h2>
        <form class="grid grid-cols-2 gap-y-8 px-8 py-8" action="../Controlador/AñadirProductoController.php" enctype="multipart/form-data" method="post">

            <label for="">Descripcion:</label>
            <input name="descripcion" class="border-solid border-2 border-black" type="text">


            <label for="">Categoría:</label>
            <input name="categoria" class="border-solid border-2 border-black" type="text">


            <label for="">Precio:</label>
            <input name="precio" class="border-solid border-2 border-black" type="number" name="" id="">


            <label for="">Stock:</label>
            <input name="stock" class="border-solid border-2 border-black" type="number">


            <label for="">Imagen:</label>
            <input name="imagen" class="border-solid border-2 border-black" type="file">

            <button class="bg-amber-200 px-4 py-2 rounded-xl col-span-2 w-1/2 place-self-center">Agregar producto</button>
        </form>
    </div>
</div>