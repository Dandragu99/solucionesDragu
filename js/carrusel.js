document.querySelectorAll('.carrusel').forEach(carrusel => {
    const contenedor = carrusel.querySelector('.imagenes');
    const imgs = contenedor.querySelectorAll('img');
    let index = 0;

    function mostrarImagenes() {
        imgs.forEach((img, i) => {
            img.style.display = (i >= index && i < index + 3) ? 'inline-block' : 'none';
        });
    }

    carrusel.querySelector('.prev').addEventListener('click', () => {
        if (index > 0) index -= 1;
        mostrarImagenes();
    });

    carrusel.querySelector('.next').addEventListener('click', () => {
        if (index < imgs.length - 3) index += 1;
        mostrarImagenes();
    });

    mostrarImagenes();
});

