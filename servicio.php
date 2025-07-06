<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicios - Reformas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <!-- Primer div: Menú de servicios -->
    <div>
        <nav>
            <a href="index.html">Inicio</a> |
            <a href="#cocina">Cocina</a> |
            <a href="#bano">Baño</a> |
            <a href="#jardin">Jardín</a> |
            <a href="#salon">Salón</a>
        </nav>
    </div>
    
    <!-- Segundo div: Reforma Baño -->
    <div id="bano" class="seccion-carrusel">
        <h2>Reforma Baño</h2>
        <div class="carrusel" data-categoria="bano">
            <button class="prev">⟨</button>
            <div class="imagenes">
                <?php include 'mostrar_imagenes.php'; mostrarCarrusel("bano"); ?>
            </div>
            <button class="next">⟩</button>
        </div>
    </div>


    <!-- Reforma Salón -->
    <div id="salon" class="seccion-carrusel">
    <h2>Pintura Salón</h2>
        <div class="carrusel" data-categoria="salon">
            <button class="prev">⟨</button>
                <div class="imagenes">
                    <?php mostrarCarrusel("salon"); ?>
                </div>
            <button class="next">⟩</button>
        </div>
    </div>


    <!-- Reforma Cocina -->
    <div id="reforma-ineterior" class="seccion-carrusel">
        <h2>Reforma Interior</h2>
        <div class="carrusel" data-categoria="reformas">
            <button class="prev">⟨</button>
                <div class="imagenes">
                    <?php 'mostrar_imagenes.php'; mostrarCarrusel("reformas"); ?>
                </div>
            <button class="next">⟩</button>
        </div>
    </div>

    <!-- Reforma Jardín -->
    <div id="jardin" class="seccion-carrusel">
        <h2>Reforma Terraza</h2>
        <div class="carrusel" data-categoria="jardin">
            <button class="prev">⟨</button>
                <div class="imagenes">
                    <?php 'mostrar_imagenes.php'; mostrarCarrusel("jardin"); ?>
                </div>
            <button class="next">⟩</button>
        </div>
    </div>

    <!-- Apartado de contacto y redes sociales -->
    <div class="contacto">
        <p>
            Síguenos:<br>
            <a href="https://facebook.com" target="_blank">Facebook</a> |
            <a href="https://instagram.com" target="_blank">Instagram</a> |
            <a href="https://twitter.com" target="_blank">Twitter</a>
        </p>
        <p>
            <strong>Teléfono de contacto:</strong> <a href="tel:+34123456789">+34 123 456 789</a>
        </p>
        <p>
            <a href="contacto.html">Ir a la página de contacto</a>
        </p>
    </div>
    <script>
        // Selecciona el carrusel(es decir, busca todos los elementos que tengan un carrusel)
        document.querySelectorAll('.carrusel').forEach(carrusel => {
            // Aquí se obtienen los elementos
            const contenedor = carrusel.querySelector('.imagenes');
            const imgs = contenedor.querySelectorAll('img');
            let index = 0; // Esta es la posición del carrusel
            // Función mostrar imágenes (no necesita explicación creo yo)
            function mostrarImagenes() {
                imgs.forEach((img, i) => {
                    // Aquí se muestra las posición de las imájgenes
                    img.style.display = (i >= index && i < index + 3) ? 'inline-block' : 'none';
                });
            }
            // Botones de navegación

            carrusel.querySelector('.prev').addEventListener('click', () => {
                if (index > 0) index--;
                mostrarImagenes();
            });

            carrusel.querySelector('.next').addEventListener('click', () => {
                if (index < imgs.length - 3) index++;
                mostrarImagenes();
            });

            mostrarImagenes();
        });
    </script>

</body>
</html>
