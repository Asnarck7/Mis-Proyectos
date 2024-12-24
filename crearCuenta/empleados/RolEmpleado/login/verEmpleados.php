<?php
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

// Consultar los empleados, ahora incluyendo el correo, teléfono, fecha de nacimiento y salario
$sql = "SELECT id, nombres, apellidos, usuario, correo, telefono, fecha_nacimiento, fecha_creacion, salario FROM empleados";
$result = $conn->query($sql);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Empleados</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 40px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
            font-size: 16px;
        }
        td {
            background-color: #f9f9f9;
            font-size: 14px;
        }
        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }
        tr:hover td {
            background-color: #f1f1f1;
        }
        .mensaje {
            text-align: center;
            font-size: 16px;
            color: green;
            margin-top: 20px;
        }
        .boton-volver {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            text-align: center;
        }
        .boton-volver:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Empleados Registrados</h1>

        <?php if ($result->num_rows > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Fecha de Creación</th>
                        <th>Salario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Definir salario mínimo en COP
                    $salario_minimo = 1160000; // Asumido como salario mínimo en COP (puedes actualizar este valor)

                    // Mostrar los resultados
                    while ($row = $result->fetch_assoc()) {
                        // Calcular el salario en función del salario mínimo
                        $salario = $row['salario'] * $salario_minimo;

                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['nombres'] . " " . $row['apellidos'] . "</td>
                                <td>" . $row['usuario'] . "</td>
                                <td>" . $row['correo'] . "</td>
                                <td>" . $row['telefono'] . "</td>
                                <td>" . $row['fecha_nacimiento'] . "</td>
                                <td>" . $row['fecha_creacion'] . "</td>
                                <td>" . number_format($salario, 0, ',', '.') . " COP</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="mensaje">No se encontraron empleados registrados.</p>
        <?php } ?>

        <!-- Botón para volver al loginEmpleado.php -->
        <a href="loginEmpleado.php" class="boton-volver">Volver al login</a>
    </div>
</body>
</html>
