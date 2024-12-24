<?php
session_start();

// Verificar si el usuario está conectado y tiene un nombre en la sesión
$nombreUsuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Invitado";

// Verificar si el ID de la habitación está presente en la URL y si es un número válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idHabitacion = $_GET['id'];
} else {
    die("Error: No se ha seleccionado una habitación válida.");
}

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

// Obtener los detalles de la habitación seleccionada
$sql = "SELECT * FROM cuartos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idHabitacion);
$stmt->execute();
$result = $stmt->get_result();
$habitacion = $result->fetch_assoc();

// Verificar si se obtuvo la habitación
if (!$habitacion) {
    die("Error: La habitación no existe.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Cuarto</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        h1, h2 {
            color: #3a0505;
            text-align: center;
        }

        h1 {
            font-size: 3em;
            margin-top: 20px;
        }

        h2 {
            font-size: 2em;
            margin-top: 10px;
        }

        p {
            text-align: center;
            font-size: 1.2em;
            margin: 20px 0;
        }

        /* Estilo para la tabla de detalles */
        .table-details {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: left;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table-details th, .table-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .table-details th {
            background-color: #3a0505;
            color: #fff;
        }

        /* Estilos para el formulario */
        form {
            width: 70%;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        form button {
            background-color: #3a0505;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            width: 100%;
        }

        form button:hover {
            background-color: #b7920d;
        }

        /* Estilos para el botón volver */
        .back-btn {
            display: block;
            margin: 30px auto;
            background-color: #3a0505;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #b7920d;
        }
    </style>
</head>
<body>
    <h1>Bienvenido a la Reserva de Cuartos</h1>
    <h2>Hola, <?php echo htmlspecialchars($nombreUsuario); ?> 😎</h2>
    <p>Aquí puedes realizar tu reserva. Por favor, llena el formulario.</p>

    <h2>Detalles de la Habitación</h2>
    <table class="table-details">
        <tr>
            <th>Tipo</th>
            <td><?php echo htmlspecialchars($habitacion['tipo_habitacion']); ?></td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td><?php echo htmlspecialchars($habitacion['descripcion']); ?></td>
        </tr>
        <tr>
            <th>Precio</th>
            <td><?php echo htmlspecialchars($habitacion['precio']); ?> USD</td>
        </tr>
        <tr>
            <th>Capacidad</th>
            <td><?php echo htmlspecialchars($habitacion['capacidad']); ?></td>
        </tr>
    </table>

    <h2>Formulario de Reserva</h2>
    <form action="procesar_reserva.php" method="POST">
        <input type="hidden" name="id_habitacion" value="<?php echo htmlspecialchars($habitacion['id']); ?>">

        <label for="nombre">Nombre Completo:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required>

        <label for="comentarios">Comentarios:</label>
        <textarea id="comentarios" name="comentarios" rows="4" placeholder="Escribe tus comentarios aquí..."></textarea>

        <label for="fecha_entrada">Fecha de Entrada:</label>
        <input type="date" id="fecha_entrada" name="fecha_entrada" required>

        <label for="fecha_salida">Fecha de Salida:</label>
        <input type="date" id="fecha_salida" name="fecha_salida" required>

        <label for="numero_personas">Número de Personas:</label>
        <input type="number" id="numero_personas" name="numero_personas" min="1" max="<?php echo htmlspecialchars($habitacion['capacidad']); ?>" required>

        <label for="metodo_pago">Método de Pago:</label>
        <select id="metodo_pago" name="metodo_pago" required>
            <option value="tarjeta_credito">Tarjeta de Crédito</option>
            <option value="tarjeta_debito">Tarjeta de Débito</option>
            <option value="efectivo">Efectivo</option>
        </select>

        <button type="submit">Reservar</button>
    </form>

    <button class="back-btn" onclick="window.location.href='reservacion.php'">Volver al Inicio</button>
</body>
</html>
