<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_pijao_del_sol";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
