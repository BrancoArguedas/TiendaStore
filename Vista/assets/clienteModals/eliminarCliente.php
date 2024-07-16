<div class="absolute hidden z-10" id="eliminarCliente">
    <div class="relative bg-red-400 rounded-[0.5rem] grid place-items-center gap-2 px-4 pb-2 text-white">
        <header class="flex items-center">
            <h2 class="text-center w-full font-bold">Eliminar</h2>
            <p onclick="closeModal('eliminarCliente')" class="cursor-pointer absolute top-0 right-0 rounded-tr-[0.5rem] px-2 bg-red-500 hover:bg-red-600">x</p>
        </header>
        <p>¿Está seguro de eliminar este cliente?</p>
        <form action="../Controlador/ClienteController.php?action=delete" method="post">
            <input type="hidden" name="eliminar_cliente_id" id="eliminar_cliente_id" >
            <button class="bg-red-500 px-2 rounded-[0.5rem] hover:bg-red-600">Eliminar</button>
        </form>
        
    </div>
</div>
