<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>JaritaStore</title>
</head>

<body>
    <?php
    include 'assets/header.php';
    ?>
    <div class="w-full h-[calc(100vh-4rem)] flex flex-col items-center gap-4 mb-4 lg:mb-0">
        <img class="h-96 w-full bg-cover" src="public/banner-index.jpeg" alt="Banner-index">
        <h1 class="text-center font-bold text-xl">¿Quiénes somos?</h1>
        <p class="w-2/3">En JaritaStore, creemos que la moda es más que ropa; es una forma de expresión personal. Fundada en 2024, nuestra tienda nació de una pasión por crear piezas únicas que combinen estilo y sostenibilidad.</p>
    </div>
    <div class="flex flex-col w-full items-center gap-4 mb-4 lg:flex-row lg:mb-0 lg:gap-0">
        <img class="w-full lg:w-1/2 lg:h-96" src="public/mision.jpeg" alt="">
        <div class="w-[90%] flex flex-col items-center gap-4 lg:w-1/2 lg:px-16">
            <h2 class="text-center font-bold text-xl">Misión</h2>
            <p>Nuestra misión es ofrecer ropa de alta calidad y diseño innovador que permita a nuestros clientes expresar su estilo personal con confianza. Nos esforzamos por ser una marca sostenible y ética, comprometida con prácticas responsables y con la creación de una experiencia de compra excepcional que inspire a nuestros clientes a sentirse bien y a hacer el bien.</p>
        </div>
    </div>
    <div class="flex flex-col w-full items-center gap-4 mb-4 lg:flex-row-reverse lg:mb-0 lg:gap-0">
        <img class="w-full lg:w-1/2 lg:h-96" src="public/vision.jpeg" alt="">
        <div class="w-[90%] flex flex-col items-center gap-4 lg:w-1/2 lg:px-16">
            <h2 class="text-center font-bold text-xl">Visión</h2>
            <p>Nuestra visión es ser la tienda de ropa líder que redefine la moda a través de la innovación, la sostenibilidad y la inclusión. Aspiramos a ser una marca globalmente reconocida por nuestra dedicación a la calidad, la responsabilidad social y la capacidad de influir positivamente en la industria de la moda y en nuestras comunidades.</p>
        </div>
    </div>
    <?php include 'assets/footer.php'; ?>
</body>

</html>