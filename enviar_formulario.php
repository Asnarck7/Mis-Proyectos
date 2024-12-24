<?php
// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

// Verificar que los datos estén completos
if ($nombre && $email && $mensaje) {
    // Preparar la consulta para insertar los datos
    $sql = "INSERT INTO mensajes (nombre, email, mensaje) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Por favor, complete todos los campos.";
}

// Cerrar la conexión
$conn->close();
?>
