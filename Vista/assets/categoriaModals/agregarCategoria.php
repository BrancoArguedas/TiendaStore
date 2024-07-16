<div id="agregarCategoria" class="absolute hidden z-10 bg-white">
    <div class="relative rounded-[0.5rem] grid place-items-center gap-2 px-4  border-solid border-[1px] border-black">
        <header class="flex items-center">
            <h2 class="text-center w-full font-bold">Agregar categoría</h2>
            <p onclick="closeModal('agregarCategoria')" class="cursor-pointer absolute top-0 right-0 rounded-tr-[0.5rem] px-2 bg-red-500 hover:bg-red-600">x</a>
        </header>
        <form class="grid grid-cols-2 gap-y-8 px-8 py-8" action="../Controlador/CategoriaControlador.php?action=create" enctype="multipart/form-data" method="post">

            <label for="">Descripcion:</label>
            <input name="descripcion" class="border-solid border-2 border-black" type="text">

            <button class="bg-amber-200 px-4 py-2 rounded-xl col-span-2 w-1/2 place-self-center">Agregar categoría</button>
        </form>
    </div>
</div>