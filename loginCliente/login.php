<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel_pijao_del_sol";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta para verificar el usuario
    $sql = "SELECT id, nombre_usuario, contrasena FROM usuarios WHERE nombre_usuario = ?";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Enlazar los parámetros
    $stmt->bind_param("s", $usuario);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $resultado = $stmt->get_result();

    // Verificar si el usuario existe
    if ($resultado->num_rows > 0) {
        // El usuario existe, verificar la contraseña
        $usuarioDB = $resultado->fetch_assoc();
        if (password_verify($contrasena, $usuarioDB['contrasena'])) {
            // La contraseña es correcta, iniciar sesión
            $_SESSION['id_usuario'] = $usuarioDB['id'];
            $_SESSION['nombre_usuario'] = $usuarioDB['nombre_usuario'];
            // Redirigir al usuario a la página de reservas
            header("Location: reservacion.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Usuario no encontrado.";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        /* Estilos para el contenedor principal */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            color: #555;
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #2575fc;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2575fc;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1a60d6;
        }

        .mensaje {
            margin-top: 15px;
            color: #e74c3c;
            font-size: 16px;
            font-weight: bold;
        }

        .volver-inicio {
            color: #e74c3c;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        .volver-inicio:hover {
            color: #fff;
            background-color: #e74c3c;
            text-decoration: none;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <!-- Formulario de inicio de sesión -->
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="input-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>

            <button type="submit">Iniciar sesión</button>

            <div style="margin-top: 20px;">
                <a href="/proyectCampamento/HOTEL_PIJAO_DEL_SOL/index.php" class="volver-inicio">Volver al inicio</a>
            </div>

            <!-- Mensaje de error o éxito -->
            <div class="mensaje">
                <?php if (isset($mensaje)) echo htmlspecialchars($mensaje); ?>
            </div>
        </form>
    </div>
</body>
</html>
