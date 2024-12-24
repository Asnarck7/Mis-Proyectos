<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_pijao_del_sol";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibieron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && isset($_POST['id_reserva'])) {
    $passwordEmpleado = $_POST['password']; // Contraseña ingresada por el empleado
    $idReserva = $_POST['id_reserva']; // ID de la reserva a eliminar

    // Consultar la contraseña del empleado (suponiendo que tienes una tabla de empleados)
    $sqlEmpleado = "SELECT contrasena FROM empleados WHERE id = 1"; // Asumimos que el id del empleado es 1 (cambiar según corresponda)
    $resultadoEmpleado = $conn->query($sqlEmpleado);

    if ($resultadoEmpleado->num_rows > 0) {
        $rowEmpleado = $resultadoEmpleado->fetch_assoc();
        $contrasenaGuardada = $rowEmpleado['contrasena'];

        // Verificar si la contraseña proporcionada es correcta
        if (password_verify($passwordEmpleado, $contrasenaGuardada)) {
            // Contraseña correcta, proceder a eliminar la reserva
            $sqlEliminar = "DELETE FROM reservas WHERE id = $idReserva";
            
            if ($conn->query($sqlEliminar) === TRUE) {
                echo "<script>alert('Reserva eliminada exitosamente'); window.location.href = 'verReservas.php';</script>";
            } else {
                echo "<script>alert('Error al eliminar la reserva'); window.location.href = 'verReservas.php';</script>";
            }
        } else {
            // Contraseña incorrecta
            echo "<script>alert('Contraseña incorrecta. No se puede eliminar la reserva.'); window.location.href = 'verReservas.php';</script>";
        }
    } else {
        echo "<script>alert('Empleado no encontrado'); window.location.href = 'verReservas.php';</script>";
    }
} else {
    echo "<script>alert('Datos incompletos'); window.location.href = 'verReservas.php';</script>";
}

// Cerrar la conexión
$conn->close();
?>
