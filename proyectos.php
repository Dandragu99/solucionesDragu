<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyectos - Reformas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    
    <!-- Primer div principal: Menú -->
    <div>
        <nav>
            <a href="index.html">Inicio</a> |
            <a href="#reformas">Reformas</a> |
            <a href="#jardin">Jardín</a> |
            <a href="#nuevas-obras">Nuevas Obras</a>
        </nav>
    </div>

    <!-- Segundo div principal: Secciones de proyectos -->
    <div id="reformas">
        <h2>Proyectos de Reformas</h2>
        <p>Descubre nuestros proyectos más destacados en reformas integrales. Transformamos espacios para adaptarlos a tus necesidades.</p>
        <div class="carrusel" data-categoria="bano">
            <button class="prev">⟨</button>
            <div class="imagenes">
                <?php include 'mostrar_imagenes.php'; mostrarCarrusel("bano"); ?>
            </div>
            <button class="next">⟩</button>
        </div>
    </div>

    <div id="jardin">
        <h2>Proyectos de Jardín</h2>
        <p>Diseñamos jardines únicos que combinan estética y funcionalidad. Aquí algunos de nuestros trabajos más recientes.</p>
        <div class="carrusel" data-categoria="salon">
            <button class="prev">⟨</button>
                <div class="imagenes">
                    <?php mostrarCarrusel("salon"); ?>
                </div>
            <button class="next">⟩</button>
        </div>
    </div>

    <div id="nuevas-obras">
        <h2>Proyectos de Nuevas Obras</h2>
        <p>Construimos desde cero con atención al detalle y materiales de alta calidad. Mira algunos de nuestros proyectos más innovadores.</p>
        <div class="carrusel" data-categoria="reformas">
            <button class="prev">⟨</button>
            <div class="imagenes">
                <?php include mostrarCarrusel("reformas"); ?>
            </div>
        </div>
    </div>

    <!-- Tercer div principal: Contacto y redes sociales -->
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
