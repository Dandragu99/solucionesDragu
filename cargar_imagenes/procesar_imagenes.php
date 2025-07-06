<?php
// procesar_imagenes.php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria = $_POST['categoria'];
    $descripcion_general = $_POST['descripcion_general'] ?? '';
    
    $imagenes_subidas = 0;
    $errores = [];
    
    // Verificar que se subieron archivos
    if (isset($_FILES['imagenes']) && !empty($_FILES['imagenes']['name'][0])) {
        
        $total_imagenes = count($_FILES['imagenes']['name']);
        
        // Procesar cada imagen
        for ($i = 0; $i < $total_imagenes; $i++) {
            
            // Verificar que no hay errores en el archivo
            if ($_FILES['imagenes']['error'][$i] === UPLOAD_ERR_OK) {
                
                $nombre_archivo = $_FILES['imagenes']['name'][$i];
                $tipo_archivo = $_FILES['imagenes']['type'][$i];
                $archivo_temporal = $_FILES['imagenes']['tmp_name'][$i];
                $tamaño_archivo = $_FILES['imagenes']['size'][$i];
                
                // Validaciones
                $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));
                
                if (!in_array($extension, $extensiones_permitidas)) {
                    $errores[] = "Archivo $nombre_archivo: Extensión no permitida";
                    continue;
                }
                
                if ($tamaño_archivo > 5 * 1024 * 1024) { // 5MB máximo
                    $errores[] = "Archivo $nombre_archivo: Demasiado grande (máx 5MB)";
                    continue;
                }
                
                // Leer el archivo como binario
                $imagen_binaria = file_get_contents($archivo_temporal);
                
                if ($imagen_binaria === false) {
                    $errores[] = "Error al leer el archivo $nombre_archivo";
                    continue;
                }
                
                // Preparar la consulta
                $consulta = "INSERT INTO imagenes (nombre, categoria, imagen, tipo, descripcion) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conexion, $consulta);
                
                if ($stmt) {
                    // Crear descripción específica para cada imagen
                    $descripcion_final = $descripcion_general;
                    if (!empty($descripcion_general)) {
                        $descripcion_final .= " - " . pathinfo($nombre_archivo, PATHINFO_FILENAME);
                    } else {
                        $descripcion_final = pathinfo($nombre_archivo, PATHINFO_FILENAME);
                    }
                    
                    mysqli_stmt_bind_param($stmt, "sssss", 
                        $nombre_archivo, 
                        $categoria, 
                        $imagen_binaria, 
                        $tipo_archivo, 
                        $descripcion_final
                    );
                    
                    if (mysqli_stmt_execute($stmt)) {
                        $imagenes_subidas++;
                    } else {
                        $errores[] = "Error al guardar $nombre_archivo: " . mysqli_error($conexion);
                    }
                    
                    mysqli_stmt_close($stmt);
                } else {
                    $errores[] = "Error en la consulta para $nombre_archivo: " . mysqli_error($conexion);
                }
            } else {
                $errores[] = "Error al subir el archivo " . $_FILES['imagenes']['name'][$i];
            }
        }
    } else {
        $errores[] = "No se seleccionaron archivos";
    }
    
    mysqli_close($conexion);
    
    // Mostrar resultados
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Resultado de Subida</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
            }
            .success {
                background: #d4edda;
                color: #155724;
                padding: 15px;
                border-radius: 5px;
                margin: 10px 0;
            }
            .error {
                background: #f8d7da;
                color: #721c24;
                padding: 15px;
                border-radius: 5px;
                margin: 10px 0;
            }
            .btn {
                display: inline-block;
                background: #007bff;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                margin: 10px 5px;
            }
            .btn:hover {
                background: #0056b3;
            }
        </style>
    </head>
    <body>
        <h1>📤 Resultado de la Subida</h1>
        
        <?php if ($imagenes_subidas > 0): ?>
            <div class="success">
                ✅ <strong>¡Éxito!</strong><br>
                Se subieron correctamente <strong><?php echo $imagenes_subidas; ?></strong> imágenes a la categoría "<strong><?php echo htmlspecialchars($categoria); ?></strong>".
            </div>
        <?php endif; ?>
        
        <?php if (!empty($errores)): ?>
            <div class="error">
                ❌ <strong>Errores encontrados:</strong><br>
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <div>
            <a href="upload_imagenes.html" class="btn">🔄 Subir Más Imágenes</a>
            <a href="proyectos.php" class="btn">👁️ Ver Proyectos</a>
            <a href="gestionar_imagenes.php" class="btn">⚙️ Gestionar Imágenes</a>
        </div>
    </body>
    </html>
    <?php
} else {
    header("Location: upload_imagenes.html");
    exit();
}
?>