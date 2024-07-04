<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>JaraTarea</title>
</head>
<body class="bg-gradient-to-r from-pink-500 to-violet-500 flex items-center justify-center h-screen">
    <div class="bg-white flex flex-col items-center justify-center rounded-3xl text-xl gap-8 py-8 px-8">
        <h2 class="text-3xl font-medium">Registrarse</h2>
        <form action="../Controlador/RegistroController.php" method="post" class="grid grid-cols-3 gap-8">
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="text" name="nombre" placeholder="Nombre" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="text" name="apellidoPaterno" placeholder="Apellido Paterno" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="text" name="apellidoMaterno" placeholder="Apellido Materno" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="email" name="email" placeholder="Correo electrónico" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="password" name="password" placeholder="Contraseña" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="password" name="repitePassword" placeholder="Repita su contraseña" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="date" name="fechaNacimiento" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="text" name="sexo" placeholder="Sexo" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="text" name="departamento" placeholder="Departamento" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="text" name="provincia" placeholder="Provincia" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="text" name="distrito" placeholder="Distrito" required>
            <input class="bg-slate-300 px-4 py-2 rounded-xl" type="text" name="direccion" placeholder="Dirección" required>
            <?php
                if(isset($_GET['error']) && $_GET['error']==1){
                    echo "<p class='text-base bg-red-200 text-red-800 text-center rounded-md' >Usuario o password son invalidos</p>";
                }
            ?>
            <input type="submit" name="registro" id="registro" value="Registrarse" class="col-span-3 place-self-center bg-red-300 w-1/3 self-center px-2 py-1 rounded-xl">
            <a href="Login.php" class="col-span-3 place-self-center">¿Ya tiene una cuenta? Inicie sesión</a>
            
        </form>
    </div>
</body>
</html>