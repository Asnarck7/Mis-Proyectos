<?php
session_start();

// Destruir la sesión
session_unset();
session_destroy();

// Redirigir al inicio de sesión
header('Location: /proyectCampamento/HOTEL_PIJAO_DEL_SOL/crearCuenta/empleados/RolEmpleado/iniciarSesionEmpleado.php');
exit();


?>
