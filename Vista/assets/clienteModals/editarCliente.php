
<div class="absolute hidden z-10 bg-white" id="editarCliente">
    <div class="relative rounded-[0.5rem] grid place-items-center gap-2 px-4  border-solid border-[1px] border-black">
        <header class="flex items-center">
            <h2 class="text-center w-full font-bold">Editar</h2>
            <p onclick="closeModal('editarCliente')" class="cursor-pointer absolute top-0 right-0 rounded-tr-[0.5rem] px-2 bg-red-500 hover:bg-red-600">x</a>
        </header>
        <form class="grid gap-y-2" action="../Controlador/ClienteController.php?action=update" method="POST">
            <input type="hidden" name="editar_cliente_id" id="editar_cliente_id" >
            <label for="nombre">Nombre
                <input type="text" name="nombreCliente" id="nombre">
            </label>
            <label for="apodo">Apodo
                <input type="text" name="apodoCliente" id="apodo">
            </label>
            <label for="direccion">Dirección
                <input type="text" name="direccionCliente" id="direccion">
            </label>
            <label for="ciudad">Ciudad
                <input type="text" name="ciudadCliente" id="ciudad">
            </label>
            <label for="codPostal">Codigo Postal
                <input type="number" name="codPostalCliente" id="codPostal">
            </label>
            <label for="pais">País
                <input type="text" name="paisCliente" id="pais">
            </label>
            
            <input type="submit" value="Editar">
        </form>
    </div>
</div>

