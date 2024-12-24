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

// Manejar el formulario de creación de cuarto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crearCuarto'])) {
    $tipo_habitacion = $_POST['tipo_habitacion'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $numero_elementos = $_POST['numero_elementos'];
    $capacidad = $_POST['capacidad'];
    $numero_habitacion = $_POST['numero_habitacion']; // Agregar el campo numero_habitacion

    // Actualizar la consulta SQL para incluir el número de habitación
    $sql = "INSERT INTO cuartos (tipo_habitacion, descripcion, precio, numero_elementos, capacidad, numero_habitacion)
            VALUES ('$tipo_habitacion', '$descripcion', '$precio', '$numero_elementos', '$capacidad', '$numero_habitacion')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Cuarto creado exitosamente.";
    } else {
        $mensaje = "Error al crear el cuarto: " . $conn->error;
    }
}

// Manejar eliminación de cuarto
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM cuartos WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Cuarto eliminado exitosamente.";
    } else {
        $mensaje = "Error al eliminar el cuarto: " . $conn->error;
    }
}

// Consultar los cuartos creados
$sql = "SELECT * FROM cuartos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuarto</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            animation: fadeIn 1.2s ease-in-out;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.7s ease-out;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 700;
        }

        form {
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
            font-size: 18px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            color: #333;
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .boton-volver {
            display: inline-block;
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .boton-volver:hover {
            background-color: #218838;
        }

        .mensaje {
            color: #28a745;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            border-radius: 8px;
            overflow: hidden;
            animation: fadeInTable 1s ease-in forwards;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            font-size: 18px;
        }

        table td {
            font-size: 16px;
        }

        .acciones a {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            margin-right: 10px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .acciones a.eliminar {
            background-color: #dc3545;
        }

        .acciones a.editar {
            background-color: #007bff;
        }

        .acciones a:hover {
            transform: scale(1.1);
        }

        .acciones a.eliminar:hover {
            background-color: #c82333;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInTable {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Crear Cuarto</h1>
        <?php if (isset($mensaje)) {
            echo "<p class='mensaje'>$mensaje</p>";
        } ?>
        <form method="POST" action="" onsubmit="return validateForm()">
            <label for="tipo_habitacion">Tipo de Habitación:</label>
            <select name="tipo_habitacion" id="tipo_habitacion" required>
                <option value="Suite">Suite</option>
                <option value="Habitación CIP">Habitación CIP</option>
                <option value="Habitación Standard">Habitación Standard</option>
                <option value="Habitación Familiar">Habitación Familiar</option>
                <option value="Habitación Ejecutiva">Habitación Ejecutiva</option>
            </select>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" required></textarea>

            <label for="precio">Precio por Noche (COP):</label>
            <input type="number" step="0.01" name="precio" id="precio" required>

            <label for="numero_elementos">Número de Elementos:</label>
            <input type="number" name="numero_elementos" id="numero_elementos" required>

            <label for="capacidad">Capacidad (N° de Personas):</label>
            <input type="number" name="capacidad" id="capacidad" required>

            <label for="numero_habitacion">Número de Habitación:</label>
            <input type="number" name="numero_habitacion" id="numero_habitacion" required>

            <button type="submit" name="crearCuarto">Crear Cuarto</button>
            <a href="loginEmpleado.php" class="boton-volver">Volver al login</a>
        </form>

        <h2>Cuartos Creados</h2>
        <table id="cuartosTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Elementos</th>
                    <th>Capacidad</th>
                    <th>Número de Habitación</th>
                    <th>Fecha Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['tipo_habitacion']}</td>
                            <td>{$row['descripcion']}</td>
                            <td>{$row['precio']}</td>
                            <td>{$row['numero_elementos']}</td>
                            <td>{$row['capacidad']}</td>
                            <td>{$row['numero_habitacion']}</td>
                            <td>{$row['fecha_creacion']}</td>
                            <td class='acciones'>
                                <a href='editar.php?id={$row['id']}' class='editar'>Editar</a>
                                <a href='?eliminar={$row['id']}' class='eliminar' onclick='return confirm(\"¿Estás seguro de eliminar este cuarto?\")'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No se han creado cuartos aún.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Validar el formulario antes de enviarlo
        function validateForm() {
            const tipoHabitacion = document.getElementById('tipo_habitacion').value;
            const descripcion = document.getElementById('descripcion').value;
            const precio = document.getElementById('precio').value;
            const numeroElementos = document.getElementById('numero_elementos').value;
            const capacidad = document.getElementById('capacidad').value;
            const numeroHabitacion = document.getElementById('numero_habitacion').value;

            if (!tipoHabitacion || !descripcion || !precio || !numeroElementos || !capacidad || !numeroHabitacion) {
                alert("Todos los campos son obligatorios.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
