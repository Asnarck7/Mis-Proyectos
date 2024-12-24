<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_pijao_del_sol"; // Usa la base de datos correcta

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO mensajes (nombre, email, mensaje) VALUES (?, ?, ?)";
    
    // Preparar la sentencia
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar los parámetros
        $stmt->bind_param("sss", $nombre, $email, $mensaje);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Si la consulta es exitosa, mostrar mensaje
            echo "<script>alert('¡Mensaje enviado con éxito!');</script>";
        } else {
            // Si ocurre un error
            echo "<script>alert('Error al enviar el mensaje. Intenta nuevamente.');</script>";
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "<script>alert('Error en la preparación de la consulta.');</script>";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <style>
        /* Diseño general */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #3a0505; /* Color rojo oscuro */
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Sección de contacto */
        #contactanos {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #3a0505;
            padding: 20px;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            color: #d4af37; /* Color dorado */
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }

        /* Estilos para el formulario */
        .input-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #3a0505;
            margin-bottom: 5px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f1f1f1;
            transition: border-color 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #d4af37; /* Color dorado al enfocar */
            outline: none;
        }

        /* Estilo para el botón de envío */
        .submit-btn {
            background-color: #d4af37;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #a17e2f; /* Un dorado más oscuro */
        }

        /* Botón de volver al inicio */
        .btn-volver {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            background-color: #d4af37;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-volver:hover {
            background-color: #a17e2f;
        }

        /* Animación para el logo */
        #logo {
            width: 150px;
            margin-bottom: 20px;
            animation: logoAnimation 1.5s ease-out forwards;
        }

        @keyframes logoAnimation {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilos responsivos */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            .submit-btn {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Sección de contacto -->
    <section id="contactanos">
        <div class="form-container">
            <!-- Logo con animación -->
            <img id="logo" src="Imagenes/LogoPijao.png" alt="Logo Pijao" />
            <h2>¡Contáctanos! Estamos aquí para ayudarte</h2>
            <p>Si tienes alguna duda o sugerencia, no dudes en escribirnos. Te responderemos lo antes posible.</p>
            <form action="contacto.php" method="post">
                <div class="input-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre completo" required />
                </div>
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico" required />
                </div>
                <div class="input-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>
                <button type="submit" class="submit-btn">Enviar</button>
            </form>
            <!-- Botón para volver al índice -->
            <a href="index.php" class="btn-volver">Volver al inicio</a>
        </div>
    </section>
</body>
</html>
