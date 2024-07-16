
<div class="absolute hidden z-10 bg-white" id="editarCategoria">
    <div class="relative rounded-[0.5rem] grid place-items-center gap-2 px-4  border-solid border-[1px] border-black">
        <header class="flex items-center">
            <h2 class="text-center w-full font-bold">Editar</h2>
            <p onclick="closeModal('editarCategoria')" class="absolute top-0 right-0 rounded-tr-[0.5rem] px-2 bg-red-500 hover:bg-red-600">x</a>
        </header>
        <form class="grid gap-y-2" action="../Controlador/CategoriaControlador.php?action=update" method="post">
            <input type="hidden" name="categoria_id" id="editar_categoria_id">
            <label for="descripcion">Descripcion
                <input type="text" name="descripcion" id="descripcion">
            </label>
            <button>Editar</button>
        </form>
    </div>
</div>
