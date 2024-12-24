<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - Opciones</title>
    <link rel="stylesheet" href="../../../../estilos.css"> <!-- Ruta al archivo de CSS -->
    <style>
        /* Estilos generales */
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f0f0f0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Contenedor de botones */
        .botones-container {
            display: flex;
            justify-content: center;
            gap: 40px;  /* Espacio entre los botones */
            margin-top: 50px;
            flex-wrap: wrap; /* Los botones se adaptarán en pantallas pequeñas */
        }

        /* Estilo de los botones */
        .boton-accion {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 20px 30px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            width: 220px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Efecto de hover */
        .boton-accion:hover {
            background-color: #0056b3;
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Efecto de enfoque */
        .boton-accion:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.5);
        }

        /* Animación para el ícono en el botón */
        .boton-accion svg {
            margin-left: 10px;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke: #fff;
            stroke-width: 2;
            transition: all 0.3s ease;
        }

        .boton-accion:hover svg {
            transform: translateX(5px);
        }

        /* Efecto activo */
        .boton-accion:active {
            transform: scale(0.95);
        }

        /* Estilo del contenedor de la página */
        .contenedor-pagina {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            background-color: #ffffff;
            padding: 20px;
        }

        /* Título principal */
        h1 {
            font-size: 36px;
            color: #007bff;
            margin-bottom: 40px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="contenedor-pagina">
        <h1>Opciones de Empleados</h1>
        <!-- Contenedor de botones -->
        <div class="botones-container">
            <!-- Botón Crear Cuenta -->
            <a href="crearEmpleados.php" class="boton-accion">Crear Cuenta</a>

            <!-- Botón Iniciar Sesión -->
            <a href="RolEmpleado/iniciarSesionEmpleado.php" class="boton-accion">Iniciar Sesión</a>
        </div>

        <!-- Botón Volver al Inicio -->
        <div style="margin-top: 30px;">
            <a href="http://localhost/proyectCampamento/HOTEL_PIJAO_DEL_SOL/" class="boton-accion">Volver al Inicio</a>
        </div>
    </div>
</body>

</html>
