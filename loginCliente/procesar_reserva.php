<?php
session_start();

// Verificar si el usuario está conectado y tiene un nombre en la sesión
if (!isset($_SESSION['nombre_usuario'])) {
    die("Error: No has iniciado sesión.");
}

$nombreUsuario = $_SESSION['nombre_usuario']; // El nombre del usuario
$idUsuario = $_SESSION['id_usuario']; // El id del usuario desde la sesión

// Verificar si los datos del formulario están presentes
if (isset($_POST['id_habitacion'], $_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['comentarios'], $_POST['fecha_entrada'], $_POST['fecha_salida'], $_POST['numero_personas'], $_POST['metodo_pago'])) {

    $idHabitacion = $_POST['id_habitacion'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $comentarios = $_POST['comentarios'];
    $fechaEntrada = $_POST['fecha_entrada'];
    $fechaSalida = $_POST['fecha_salida'];
    $numeroPersonas = $_POST['numero_personas'];
    $metodoPago = $_POST['metodo_pago'];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel_pijao_del_sol";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta para insertar la reserva
    $sql = "INSERT INTO reservas (id_habitacion, id_usuario, nombre, correo, telefono, comentarios, fecha_entrada, fecha_salida, numero_personas, metodo_pago, fecha_reserva)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar los parámetros
        $stmt->bind_param("iissssssss", $idHabitacion, $idUsuario, $nombre, $correo, $telefono, $comentarios, $fechaEntrada, $fechaSalida, $numeroPersonas, $metodoPago);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "😎";
        } else {
            echo "Error al realizar la reserva: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    die("Error: Faltan datos en el formulario.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Confirmada</title>
    <style>
        /* Reseteo de márgenes y paddings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Fondo de la página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        /* Contenedor principal */
        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 800px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Títulos */
        h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        /* Formulario */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            color: #555;
        }

        input, textarea, select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #007BFF;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #c0392b;
        }

        /* Estilo para el contenedor de la tabla de detalles */
        .habitacion-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .habitacion-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .habitacion-details th, .habitacion-details td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .habitacion-details th {
            background-color: #007BFF;
            color: white;
        }

        /* Mejorar la apariencia del botón de "Volver" */
        .back-btn {
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>¡Reserva Exitosa!</h1>
        <h2>Gracias por realizar tu reserva, <?php echo htmlspecialchars($nombreUsuario); ?>.</h2>

        <!-- Detalles de la reserva -->
        <div class="habitacion-details">
            <table>
                <tr>
                    <th>Habitación</th>
                    <td><?php echo htmlspecialchars($idHabitacion); ?></td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td><?php echo htmlspecialchars($nombre); ?></td>
                </tr>
                <tr>
                    <th>Correo</th>
                    <td><?php echo htmlspecialchars($correo); ?></td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td><?php echo htmlspecialchars($telefono); ?></td>
                </tr>
                <tr>
                    <th>Comentarios</th>
                    <td><?php echo htmlspecialchars($comentarios); ?></td>
                </tr>
                <tr>
                    <th>Fecha de Entrada</th>
                    <td><?php echo htmlspecialchars($fechaEntrada); ?></td>
                </tr>
                <tr>
                    <th>Fecha de Salida</th>
                    <td><?php echo htmlspecialchars($fechaSalida); ?></td>
                </tr>
                <tr>
                    <th>Número de Personas</th>
                    <td><?php echo htmlspecialchars($numeroPersonas); ?></td>
                </tr>
                <tr>
                    <th>Metodo de Pago</th>
                    <td><?php echo htmlspecialchars($metodoPago); ?></td>
                </tr>
            </table>
        </div>

        <!-- Botón para volver -->
        <a href="reservacion.php">
            <button class="back-btn">Volver</button>
        </a>
    </div>

</body>
</html>
