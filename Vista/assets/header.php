
<header class="flex w-full h-16 justify-around items-center bg-[#525B76] font-medium">
    <a href="../Index.php">
        <h2>JaraStore</h2>
    </a>
    <a href="./Index.php">
        Inicio
    </a>
    <a href="./Productos.php">
        Productos
    </a>
    <?php
        if(isset($_SESSION['usuario_id']) || isset($_SESSION['cliente_id'])){
    ?>
    <a class="px-4 py-1 rounded-xl border-solid border-amber-200 border-2" href="./Dashboard.php">
        Perfil
    </a>
    <a class="bg-amber-200 px-4 py-1 rounded-xl border-solid border-amber-200 border-2 hover:bg-transparent duration-300" href="assets/cerrarSesion.php">
        Cerrar sesión
    </a>
    <?php
        }else{
    ?>
    <a class="px-4 py-1 rounded-xl border-solid border-amber-200 border-2" href="./Login.php">
        Iniciar sesión
    </a>
    <a class="bg-amber-200 px-4 py-1 rounded-xl border-solid border-amber-200 border-2 hover:bg-transparent duration-300" href="./Registro.php">
        Registrarse 
    </a>
    <?php } ?>
</header>