<?php
// mostrar_imagenes.php
include 'conexion.php';

// Función que muestra las imágenes dentro del carrusel
function mostrarCarrusel($categoria) {
    global $conexion;
    // Una vez creada y enlazada la conexión al bbdd, creamos la función, y la consulta.
    // En la consulta se le da un límte de imágenes para que aparezcan más cambiar el LIMIT
    $consulta = "SELECT * FROM imagenes WHERE categoria = ? ORDER BY fecha_subida DESC LIMIT 18";
    // Crea la statement para subir la consulta a la base de datos.
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $categoria);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($resultado) > 0) {
        while ($imagen = mysqli_fetch_assoc($resultado)) {
            // Convierte las imágenes en binarias a formato base64,
            // Las muestra como imágenes HTML directamente
            $imagen_base64 = base64_encode($imagen['imagen']);
            $tipo_imagen = htmlspecialchars($imagen['tipo']);
            $descripcion = htmlspecialchars($imagen['descripcion']);
            
            echo "<img src='data:$tipo_imagen;base64,$imagen_base64' alt='$descripcion' width='200'>";
        }
    } else {
        echo "<p>No hay imágenes disponibles en esta categoría.</p>";
    }
    
    mysqli_stmt_close($stmt);
}
?>
