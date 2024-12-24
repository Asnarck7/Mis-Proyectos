<?php
// Procesar datos si el formulario ha sido enviado
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Datos de conexión a la base de datos
    $servidor = "localhost"; // Cambia si tu servidor no es local
    $usuario_bd = "root";    // Cambia si tienes otro usuario
    $contrasena_bd = "";     // Cambia si tienes una contraseña
    $base_datos = "hotel_pijao_del_sol"; // Nombre de tu base de datos

    // Crear la conexión
    $conn = new mysqli($servidor, $usuario_bd, $contrasena_bd, $base_datos);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener y procesar los datos del formulario
    $nombres = $conn->real_escape_string($_POST['nombres']);
    $apellidos = $conn->real_escape_string($_POST['apellidos']);
    $nombre_usuario = $conn->real_escape_string($_POST['nombre_usuario']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    // Verificar si el nombre de usuario o correo ya existe
    $consulta = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' OR correo = '$correo'";
    $resultado = $conn->query($consulta);

    if ($resultado->num_rows > 0) {
        $mensaje = "El nombre de usuario o correo ya está registrado.";
    } else {
        // Insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (nombres, apellidos, nombre_usuario, correo, contrasena) 
                VALUES ('$nombres', '$apellidos', '$nombre_usuario', '$correo', '$contrasena')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Cuenta creada exitosamente.";
        } else {
            $mensaje = "Error: " . $conn->error;
        }
    }

    // Cerrar conexión
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <style>
        /* Estilos básicos */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeIn 1s ease-out;
        }

        /* Animación de desvanecimiento para el fondo */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Modal de contenido */
        .modal-content2 {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
            overflow: hidden;
            animation: slideIn 0.8s ease-out;
        }

        /* Animación para el modal */
        @keyframes slideIn {
            0% {
                transform: translateY(-50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Estilo del encabezado */
        h2 {
            color: #444;
            font-size: 26px;
            margin-bottom: 25px;
            font-weight: 700;
            animation: fadeInUp 1s ease-out;
        }

        /* Animación para el encabezado */
        @keyframes fadeInUp {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Estilo para los inputs */
        input {
            width: 90%;
            padding: 14px;
            margin: 12px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out;
        }

        /* Animación al enfocar los inputs */
        input:focus {
            border-color: #5cb85c;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(92, 184, 92, 0.4);
        }

        /* Estilo para los botones */
        button {
            width: 100%;
            padding: 14px;
            margin: 15px 0;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            animation: fadeInUp 1s ease-out;
        }

        /* Efecto al pasar el ratón sobre los botones */
        button:hover {
            background-color: #4cae4c;
            transform: scale(1.05);
        }

        /* Estilo para el mensaje */
        .mensaje {
            color: #e74c3c;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Botón Volver */
        .boton-volver {
            background-color: #e74c3c;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            margin-top: 15px;
            width: 100%;
            animation: fadeInUp 1s ease-out;
        }

        /* Estilo al pasar el ratón sobre el botón Volver */
        .boton-volver:hover {
            background-color: #c0392b;
        }

        /* Opcional: Asegurar que el enlace en el botón Volver no tenga subrayado */
        .boton-volver a {
            color: white;
            text-decoration: none;
        }

        /* Cerrar Modal */
        .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
            transition: color 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #333;
        }
    </style>
</head>

<body>
    <div class="modal-content2">
        <span class="close" id="closeButton">&times;</span>
        <h2>Crear Cuenta</h2>
        <form action="" method="POST">
            <input type="text" name="nombres" placeholder="Nombres" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <input type="text" name="nombre_usuario" placeholder="Nombre de Usuario" required>
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Crear Cuenta</button>
            <button type="button" class="boton-volver"><a href="\proyectCampamento\HOTEL_PIJAO_DEL_SOL\index.php">Volver a Inicio</a></button>
        </form>
        <div class="mensaje">
            <?php if ($mensaje) echo $mensaje; ?>
        </div>
    </div>
</body>

</html>
