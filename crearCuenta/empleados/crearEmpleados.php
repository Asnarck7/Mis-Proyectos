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
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $salario = $_POST['salario'];  // Recoger el salario

    // Validar que la contraseña coincida
    if ($contrasena !== $confirmar_contrasena) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Encriptar la contraseña
        $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Comprobar si el nombre de usuario o el correo ya existen
        $query = "SELECT * FROM empleados WHERE usuario = ? OR correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $usuario, $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "El nombre de usuario o correo ya están en uso.";
        } else {
            // Insertar el nuevo empleado en la base de datos, incluyendo el salario
            $query = "INSERT INTO empleados (nombres, apellidos, usuario, fecha_nacimiento, telefono, correo, contrasena, salario) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssssd", $nombres, $apellidos, $usuario, $fecha_nacimiento, $telefono, $correo, $contrasena_encriptada, $salario);

            if ($stmt->execute()) {
                $success = "Empleado creado con éxito.";
            } else {
                $error = "Hubo un error al crear el empleado. Intente de nuevo.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empleado</title>
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

        button {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button a {
            color: white;
            text-decoration: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .button-container a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Crear Cuenta de Empleado</h2>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>

        <form action="crearEmpleados.php" method="POST">
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>

            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" maxlength="20" required>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="confirmar_contrasena">Confirmar Contraseña:</label>
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>

            <!-- Nuevo campo de salario -->
            <label for="salario">Salario:</label>
            <input type="number" id="salario" name="salario" step="0.01" required>

            <button type="submit">Crear Cuenta</button>
        </form>

        <div class="button-container">
            <a href="indexEmpleados.php">Volver a Inicio</a>
        </div>
    </div>

</body>
</html>
