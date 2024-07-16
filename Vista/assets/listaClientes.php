<?php
require_once '../Controlador/ClienteController.php';
$clienteController = new ClienteController();
$clientes = $clienteController->leerCliente();

?>
<div id="listaClientes" class="toggleDiv px-4 py-2 w-full">
    <h2 class="text-center my-4 text-xl font-medium">Clientes</h2>
    <table class="w-full ">
        <thead>
            <tr>
                <th class="px-2 py-2">Nombre</th>
                <th class="px-2 py-2">Apodo</th>
                <th class="px-8 py-2">País</th>
                <th class="px-2 py-2">Ciudad</th>
                <th class="px-2 py-2">Dirección</th>
                <th class="px-2 py-2">Código Postal</th>
                <th class="px-2 py-2"></th>
                <th class="px-2 py-2"></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($clientes) : ?>
                <?php foreach ($clientes as $cliente) : ?>
                    <tr>
                        <td class="text-center text-sm"><?= $cliente['nombre'] ?></td>
                        <td class="text-center text-sm"><?= $cliente['apodo'] ?></td>
                        <td class="text-center text-sm"><?= $cliente['pais'] ?></td>
                        <td class="text-center text-sm"><?= $cliente['ciudad'] ?></td>
                        <td class="text-center text-sm"><?= $cliente['direccion'] ?></td>
                        <td class="text-center text-sm"><?= $cliente['codPostal'] ?></td>
                        <td class="text-center">
                            <a href="#" data-id="<?= htmlspecialchars($cliente['id']) ?>" onclick="openModalClientes(event, 'editarCliente', this)">
                                <ion-icon class="text-green-500 font-bold" name="create-outline"></ion-icon>
                            </a>
                        </td>
                        <td class="text-center py-4">
                            <a href="#" data-id="<?= htmlspecialchars($cliente['id']) ?>" onclick="openModalClientes(event, 'eliminarCliente', this)">
                                <ion-icon class="text-red-800" name="trash-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">NO HAY CLIENTES REGISTRADOS</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php
include './assets/clienteModals/agregarCliente.php';
include './assets/clienteModals/eliminarCliente.php';
include './assets/clienteModals/editarCliente.php';
?>
<script>
    let currentClienteId = '';

    function openModalClientes(event, id, element) {
        event.preventDefault();
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('block');

        currentClienteId = element.getAttribute('data-id');
        console.log('Cliente ID:', currentClienteId);

        const inputEditarId = document.getElementById('editar_cliente_id');
        const inputEliminarId = document.getElementById('eliminar_cliente_id');

        if (id === 'editarCliente') {
            inputEditarId.value = currentClienteId;
            console.log('Hidden Input Value:', inputEditarId.value); // Imprimir el valor del input hidden
        }else if( id === 'eliminarCliente' ){
            inputEliminarId.value = currentClienteId;
            console.log('Hidden Input Value:', inputEliminarId.value);
        }
    }

    
</script>