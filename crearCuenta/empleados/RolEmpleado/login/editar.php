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

// Obtener el ID del cuarto a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar la información del cuarto
    $sql = "SELECT * FROM cuartos WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    die("Error: ID no proporcionado.");
}

// Manejar el formulario de edición de cuarto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editarCuarto'])) {
    $tipo_habitacion = $_POST['tipo_habitacion'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $numero_elementos = $_POST['numero_elementos'];
    $capacidad = $_POST['capacidad'];
    $numero_habitacion = $_POST['numero_habitacion']; // Nuevo campo

    // Actualizar el cuarto en la base de datos
    $sql = "UPDATE cuartos SET tipo_habitacion='$tipo_habitacion', descripcion='$descripcion', precio='$precio', numero_elementos='$numero_elementos', capacidad='$capacidad', numero_habitacion='$numero_habitacion' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Cuarto actualizado exitosamente.";
        // Redirigir a la página de creación de cuartos
        header("Location: crearCuarto.php");
        exit();
    } else {
        $mensaje = "Error al actualizar el cuarto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cuarto</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .mensaje {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .back-btn {
            display: inline-block;
            background-color: #f44336;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            margin-top: 20px;
            font-weight: 500;
        }
        .back-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Cuarto</h1>
        <?php if (isset($mensaje)) { echo "<p class='mensaje'>$mensaje</p>"; } ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="tipo_habitacion">Tipo de Habitación:</label>
                <select name="tipo_habitacion" id="tipo_habitacion" required>
                    <option value="Suite" <?php echo ($row['tipo_habitacion'] == 'Suite') ? 'selected' : ''; ?>>Suite</option>
                    <option value="Habitación CIP" <?php echo ($row['tipo_habitacion'] == 'Habitación CIP') ? 'selected' : ''; ?>>Habitación CIP</option>
                    <option value="Habitación Standard" <?php echo ($row['tipo_habitacion'] == 'Habitación Standard') ? 'selected' : ''; ?>>Habitación Standard</option>
                    <option value="Habitación Familiar" <?php echo ($row['tipo_habitacion'] == 'Habitación Familiar') ? 'selected' : ''; ?>>Habitación Familiar</option>
                    <option value="Habitación Ejecutiva" <?php echo ($row['tipo_habitacion'] == 'Habitación Ejecutiva') ? 'selected' : ''; ?>>Habitación Ejecutiva</option>
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" rows="4" required><?php echo $row['descripcion']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="precio">Precio por Noche (COP):</label>
                <input type="number" step="0.01" name="precio" id="precio" value="<?php echo $row['precio']; ?>" required>
            </div>

            <div class="form-group">
                <label for="numero_elementos">Número de Elementos:</label>
                <input type="number" name="numero_elementos" id="numero_elementos" value="<?php echo $row['numero_elementos']; ?>" required>
            </div>

            <div class="form-group">
                <label for="capacidad">Capacidad (N° de Personas):</label>
                <input type="number" name="capacidad" id="capacidad" value="<?php echo $row['capacidad']; ?>" required>
            </div>

            <div class="form-group">
                <label for="numero_habitacion">Número de Habitación:</label>
                <input type="number" name="numero_habitacion" id="numero_habitacion" value="<?php echo $row['numero_habitacion']; ?>" required>
            </div>

            <button type="submit" name="editarCuarto">Actualizar Cuarto</button>
        </form>

        <!-- Botón para volver dentro del contenedor -->
        <a href="javascript:history.back()" class="back-btn">Volver</a>
    </div>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
