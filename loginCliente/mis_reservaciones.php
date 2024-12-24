<?php
session_start();

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$servidor = "localhost";
$usuario_bd = "root";
$contrasena_bd = "";
$base_datos = "hotel_pijao_del_sol";

$conn = new mysqli($servidor, $usuario_bd, $contrasena_bd, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el id del usuario de la sesión
$usuario_id = $conn->real_escape_string($_SESSION['id_usuario']);

// Consultar el nombre del usuario
$sql_usuario = "SELECT nombres FROM usuarios WHERE id = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("i", $usuario_id);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();

// Verificar si se encontró el nombre del usuario
if ($result_usuario->num_rows > 0) {
    $usuario = $result_usuario->fetch_assoc();
    $nombre_usuario = $usuario['nombres'];
} else {
    $nombre_usuario = 'Usuario';
}

// Consulta para obtener las reservas del usuario
$sql = "SELECT * FROM reservas WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

// Mostrar las reservas si existen
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservaciones</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
            opacity: 0;
            animation: fadeIn 1s forwards;
            /* Animación de fade-in */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2575fc;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2575fc;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #c0392b;
        }

        .no-reservations {
            color: #e74c3c;
            font-size: 18px;
            text-align: center;
        }

        .back-btn,
        .cancel-btn {
            display: block;
            margin-top: 30px;
            padding: 12px 25px;
            background-color: #2c3e50;
            /* Nuevo color para el botón */
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            width: 200px;
            margin: 30px auto 0;
            font-size: 16px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .back-btn:hover,
        .cancel-btn:hover {
            background-color: #34495e;
            /* Nuevo color de hover para el botón */
            transform: scale(1.1);
            /* Aumenta el tamaño al pasar el mouse */
        }

        .cancel-btn {
            background-color: #c0392b;
            width: auto;
            padding: 8px 15px;
            display: inline-block;
            margin-right: 10px;
        }

        .cancel-btn:hover {
            background-color: #e74c3c;
            transform: scale(1.1);
        }

        .back-btn:hover {
            background-color: #1a60d6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Bienvenido, <?= htmlspecialchars($nombre_usuario) ?>!</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <p>Aquí puedes ver tus reservaciones:</p>
            <table>
                <tr>
                    <th>ID</th>
                    <th>ID Habitacion</th>
                    <th>Fecha de Entrada</th>
                    <th>Fecha de Salida</th>
                    <th>Número de Personas</th>
                    <th>Comentarios</th>
                    <th>Acción</th>
                </tr>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['id']) ?></td>
                        <td>
                            <?php
                            // Asignar nombre de habitación según el id
                            switch ($fila['id_habitacion']) {
                                case 1:
                                    echo "Suite";
                                    break;
                                case 2:
                                    echo "Habitación CIP";
                                    break;
                                case 3:
                                    echo "Habitación Standard";
                                    break;
                                case 4:
                                    echo "Habitación";
                                    break;
                                case 5:
                                    echo "Habitación Ejecutiva Familiar";
                                    break;
                                case 6:
                                    echo "Habitación Ejecutiva";
                                    break;
                                default:
                                    echo "Habitación No Definida"; // Si el id no coincide con ninguno
                            }
                            ?>
                        </td>
                        <td><?= htmlspecialchars($fila['fecha_entrada']) ?></td>
                        <td><?= htmlspecialchars($fila['fecha_salida']) ?></td>
                        <td><?= htmlspecialchars($fila['numero_personas']) ?></td>
                        <td><?= htmlspecialchars($fila['comentarios']) ?></td>
                        <td><a href="cancelar_reserva.php?id=<?= urlencode($fila['id']) ?>" class="cancel-btn">Cancelar</a></td>
                    </tr>

                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p class="no-reservations">No tienes reservas en este momento.</p>
        <?php endif; ?>

        <a href="reservacion.php" class="back-btn">Volver al inicio</a>
    </div>
</body>

</html>
<?php
$stmt->close();
$stmt_usuario->close();
$conn->close();
?>