<?php
// Iniciar sesión y conexión con la base de datos
session_start();

$host = 'localhost';
$username = 'root'; // Tu usuario de MySQL
$password = ''; // Tu contraseña de MySQL
$database = 'hotel_pijao_del_sol'; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($host, $username, $password, $database);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consultar si el usuario existe en la base de datos
    $query = "SELECT * FROM empleados WHERE usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El usuario existe, verificar la contraseña
        $empleado = $result->fetch_assoc();
        if (password_verify($contrasena, $empleado['contrasena'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['empleado_id'] = $empleado['id'];
            $_SESSION['usuario'] = $empleado['usuario'];

            // Redirigir a la página principal (loginEmpleado.php)
            header('Location: ../RolEmpleado/login/loginEmpleado.php');
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El usuario no existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Empleado</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            width: 380px;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        label {
            width: 100%;
            margin-bottom: 8px;
            color: #555;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            color: #333;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Estilo general para los botones */
        button,
        .button-container a {
            display: inline-block;
            padding: 12px 20px;
            text-align: center;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            /* Efecto de aumento en el hover */
        }

        .button-container a {
            color: #007bff;
            background-color: #f0f0f0;
            border: 1px solid #007bff;
            margin-top: 10px;
            padding: 12px 20px;
            text-align: center;
            width: auto;
            display: inline-block;
        }

        .button-container a:hover {
            background-color: #007bff;
            color: white;
            transform: scale(1.05);
            /* Efecto de aumento en el hover */
        }

        .button-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 15px;
            /* Espaciado entre los botones */
        }

        /* Asegura que los enlaces se alineen bien en el contenedor */
        .button-container a {
            width: 48%;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Iniciar Sesión</h2>

        <?php if (isset($error)) {
            echo "<p class='error'>$error</p>";
        } ?>

        <form action="iniciarSesionEmpleado.php" method="POST">
            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
        <div class="button-container">
            <a href="\proyectCampamento\HOTEL_PIJAO_DEL_SOL\index.php">Volver a Inicio</a>
        </div>
        <div class="button-container">
            <a href="/proyectCampamento/HOTEL_PIJAO_DEL_SOL/crearCuenta/empleados/crearEmpleados.php">Crear Cuenta</a>
        </div>
    </div>


</body>

</html>