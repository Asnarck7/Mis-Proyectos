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

// Consultar las reservaciones
$sql = "SELECT id, nombre, correo, telefono, comentarios, fecha_entrada, fecha_salida, numero_personas, metodo_pago, fecha_reserva, id_usuario FROM reservas";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reservaciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
        .boton-eliminar {
            background-color: #ff5c5c;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }
        .boton-eliminar:hover {
            background-color: #d9534f;
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

        /* Estilo para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .input-password {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            width: 100%;
        }
        .confirmar-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .confirmar-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Reservaciones Registradas</h1>

        <?php if ($result->num_rows > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Reserva</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Comentarios</th>
                        <th>Fecha de Entrada</th>
                        <th>Fecha de Salida</th>
                        <th>Número de Personas</th>
                        <th>Método de Pago</th>
                        <th>Fecha de Reserva</th>
                        <th>ID Usuario</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar los resultados
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['nombre'] . "</td>
                                <td>" . $row['correo'] . "</td>
                                <td>" . $row['telefono'] . "</td>
                                <td>" . $row['comentarios'] . "</td>
                                <td>" . $row['fecha_entrada'] . "</td>
                                <td>" . $row['fecha_salida'] . "</td>
                                <td>" . $row['numero_personas'] . "</td>
                                <td>" . $row['metodo_pago'] . "</td>
                                <td>" . $row['fecha_reserva'] . "</td>
                                <td>" . $row['id_usuario'] . "</td>
                                <td><button class='boton-eliminar' onclick='openModal(" . $row['id'] . ")'>Eliminar</button></td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No se encontraron reservaciones registradas.</p>
        <?php } ?>

        <!-- Botón para volver al loginEmpleado.php -->
        <a href="loginEmpleado.php" class="boton-volver">Volver al login</a>
    </div>

    <!-- Modal de confirmación -->
    <div id="modalEliminar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Ingrese la contraseña del empleado para confirmar:</h2>
            <form method="POST" action="confirmarEliminacion.php" id="formEliminar">
                <input type="hidden" name="id_reserva" id="idReserva">
                <input type="password" class="input-password" name="password" placeholder="Contraseña" required>
                <button type="submit" class="confirmar-btn">Confirmar</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(reservaId) {
            document.getElementById('idReserva').value = reservaId;
            document.getElementById('modalEliminar').style.display = "block";
        }

        function closeModal() {
            document.getElementById('modalEliminar').style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('modalEliminar')) {
                closeModal();
            }
        }
    </script>

</body>
</html>
