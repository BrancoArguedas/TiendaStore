
<header class="bg-red-400 flex items-center justify-between min-h-16 px-4 fixed w-full top-0 lg:px-16">

    <a href="./Index.php" class="flex gap-2 items-center">
        <img src="./public/logo.jpeg" class="w-12" alt="Logo">
        <h2>Tienda</h2>
    </a>
    
    <div id="iconoMenu" class="flex flex-col gap-1 md:hidden" onclick="mostrarNav()">
        <div class="h-1 w-8 rounded-xl bg-red-700"></div>
        <div class="h-1 w-8 rounded-xl bg-red-700"></div>
        <div class="h-1 w-8 rounded-xl bg-red-700"></div>
    </div>
    <ul id="nav" class="hidden flex-col absolute top-16 w-full left-0 bg-red-400 md:flex md:flex-row md:top-auto md:left-auto md:static md:justify-self-end md:w-auto md:gap-16 lg:gap-32">
        <li class="py-2 text-center">
            <a href="Index.php">Inicio</a>
        </li>
        <li class="py-2 text-center">
            <a href="Nosotros.php">Nosotros</a>
        </li>
        <?php if ( isset($_SESSION['rol'])) : ?>
            
            <li class="py-2 text-center">
                <?php if($_SESSION['rol'] == "admin"): ?>
                    <a href="Dashboard.php">Perfil</a>
                <?php elseif ($_SESSION['rol'] == "cliente"): ?>
                    <a href="miPerfil.php">Perfil</a>
                <?php endif;?>
            </li>

            <li class="py-2 text-center">
                <a href="./assets/cerrarSesion.php">Cerrar sesión</a>
            </li>
            <?php if ($_SESSION['rol'] == "cliente"): ?>
            <li class="py-2 text-center">
                <a href="carritoCompra.php" class="text-2xl"><ion-icon name="cart-outline"></ion-icon></a>
            </li>
            <?php endif; ?>
        <?php else:  ?>
            <li class="py-2 text-center">
                <a href="Login.php">Iniciar sesión</a>
            </li>
            <li class="py-2 text-center">
                <a href="Registro.php">Registrarse</a>
            </li>
        <?php endif; ?>
    </ul>
</header>

<script>
    function mostrarNav() {
        const nav = document.getElementById("nav");
        nav.classList.toggle("hidden");
    }
</script>