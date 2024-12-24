<?php
session_start();

// Verificar si el usuario ha iniciado sesión
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

// Verificar si se ha enviado el id de la reserva
if (isset($_GET['id'])) {
    $reserva_id = $conn->real_escape_string($_GET['id']);

    // Comprobar si la reserva pertenece al usuario
    $sql = "SELECT * FROM reservas WHERE id = ? AND id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $reserva_id, $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Si la reserva existe y pertenece al usuario, mostrar el mensaje de confirmación
    if ($resultado->num_rows > 0) {
        $reserva = $resultado->fetch_assoc();
        $mensaje_reserva = "¿Estás seguro de que deseas cancelar esta reserva?";
        $detalles_reserva = "Reserva ID: " . $reserva['id'] . " - Fecha de entrada: " . $reserva['fecha_entrada'] . " - Fecha de salida: " . $reserva['fecha_salida'];
    } else {
        $mensaje_reserva = "No se encontró la reserva o no pertenece a tu cuenta.";
    }

    $stmt->close();
} else {
    $mensaje_reserva = "No se ha especificado una reserva para cancelar.";
}

// Verificar si el usuario ha confirmado la cancelación
if (isset($_POST['confirmar_cancelacion']) && $_POST['confirmar_cancelacion'] == 'si') {
    // Eliminar la reserva
    $sql_eliminar = "DELETE FROM reservas WHERE id = ?";
    $stmt_eliminar = $conn->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $reserva_id);
    if ($stmt_eliminar->execute()) {
        $mensaje = "Reserva cancelada exitosamente.";
    } else {
        $mensaje = "Hubo un error al cancelar la reserva.";
    }

    $stmt_eliminar->close();
} elseif (isset($_POST['confirmar_cancelacion']) && $_POST['confirmar_cancelacion'] == 'no') {
    $mensaje = "La cancelación fue cancelada.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelar Reserva</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .message-box {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            display: inline-block;
        }
        .button {
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #c0392b;
        }
        .back-btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #2575fc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #1a60d6;
        }
    </style>
</head>
<body>

    <?php if (isset($mensaje_reserva)): ?>
        <div class="message-box">
            <h2><?= $mensaje_reserva ?></h2>
            <?php if (isset($detalles_reserva)): ?>
                <p><?= $detalles_reserva ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (!isset($mensaje)): ?>
        <h3><?= $mensaje_reserva ?></h3>
        <form method="POST">
            <button type="submit" name="confirmar_cancelacion" value="si" class="button">Sí, cancelar reserva</button>
            <button type="submit" name="confirmar_cancelacion" value="no" class="button">No, volver atrás</button>
        </form>
    <?php else: ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>
    
    <a href="mis_reservaciones.php" class="back-btn">Volver a Mis Reservas</a>
</body>
</html>
