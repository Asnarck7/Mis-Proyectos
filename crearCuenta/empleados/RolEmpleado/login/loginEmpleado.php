<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['empleado_id'])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header('Location: iniciarSesionEmpleado.php');
    exit();
}

// Si está autenticado, muestra el contenido del panel
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            opacity: 0;
            animation: fadeIn 1.5s forwards;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            animation: slideIn 1s ease-out forwards;
            opacity: 0;
            transform: translateY(50px);
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 18px;
        }

        .btn {
            display: inline-block;
            margin: 15px 0;  /* Aumenté el espacio vertical entre los botones */
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            opacity: 0;
            animation: buttonFadeIn 1s forwards;
            transform: scale(1);
            transition: all 0.3s ease;
        }

        /* Efecto hover con animación */
        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.1); /* Escala al pasar el mouse */
            box-shadow: 0px 4px 15px rgba(0, 123, 255, 0.5); /* Sombra al pasar el mouse */
        }

        .btn-logout {
            background-color: #dc3545;
        }

        .btn-logout:hover {
            background-color: #c82333;
            transform: scale(1.1);
            box-shadow: 0px 4px 15px rgba(220, 53, 69, 0.5);
        }

        /* Animaciones */
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes buttonFadeIn {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h1>
        <p>Has iniciado sesión exitosamente.</p>

        <!-- Botón de logout -->
        <form action="logoutEmpleado.php" method="POST">
            <button class="btn btn-logout" type="submit">Cerrar sesión</button>
        </form>

        <!-- Botones adicionales -->
        <a href="crearCuarto.php" class="btn">Crear Cuarto</a>
        <a href="verEmpleados.php" class="btn">Ver Empleados</a>
        <a href="verReservas.php" class="btn">Ver Reservas</a> <!-- Botón de Ver Reservas -->
    </div>
</body>
</html>
