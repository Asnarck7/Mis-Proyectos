<?php
session_start();

// Verificar si el usuario está conectado y tiene un nombre en la sesión
$nombreUsuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Invitado";

// Obtener el ID del usuario desde la sesión
$idUsuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

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

// Consultar los cuartos disponibles
$sql = "SELECT * FROM cuartos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservación de Cuartos</title>
    <style>
        /* Incluye los estilos aquí */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            box-sizing: border-box;
            opacity: 0;
            /* Inicialmente invisible */
            animation: fadeIn 1s forwards;
            /* Animación de desvanecimiento */
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
                /* Desplazamiento desde abajo */
            }

            to {
                opacity: 1;
                transform: translateY(0);
                /* Vuelve a su posición original */
            }
        }

        h1,
        h2 {
            margin: 20px 0;
            text-align: center;
            color: #2c3e50;
        }

        /* Estilos de la tabla */
        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        td {
            background-color: #ecf0f1;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        /* Estilos de los botones */
        button,
        .logout-btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button {
            background-color: #28a745;
            color: white;
        }

        button:hover {
            background-color: #218838;
        }

        .logout-btn {
            margin-top: 20px;
            background-color: #e74c3c;
            color: white;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        /* Estilo del botón de reservación */
        .btn {
            position: relative;
            display: inline-block;
            width: 277px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            text-transform: uppercase;
            background-color: transparent;
            cursor: pointer;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
            font-weight: 900;
            font-size: 17px;
            letter-spacing: 0.045em;
        }

        .btn svg {
            position: absolute;
            top: 0;
            left: 0;
        }

        .btn svg rect {
            stroke: #EC0033;
            stroke-width: 4;
            stroke-dasharray: 353, 0;
            stroke-dashoffset: 0;
            transition: all 600ms ease;
        }

        .btn span {
            background: linear-gradient(to right, #6A1B3D 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn:hover svg rect {
            stroke-dasharray: 196, 543;
            stroke-dashoffset: 437;
        }
    </style>
</head>

<body>
    <br>
    <br>
    <h1>Bienvenido al Hotel Pijao del Sol</h1>
    <h2>Hola, <?php echo htmlspecialchars($nombreUsuario); ?> 👋</h2> <!-- Mostrando el nombre del usuario -->
    <br>
    <br>
    <!-- En el archivo reservacion.php -->
    <a href="mis_reservaciones.php" class="btn">
        <svg width="100%" height="100%">
            <rect x="0" y="0" fill="none" width="100%" height="100%"></rect>
        </svg>
        <span>Ver Mis Reservaciones</span>
    </a>

    <br>
    <br>
    <br>
    <button class="logout-btn" onclick="window.location.href='logout.php'">Cerrar sesión</button>
    <br>
    <br>
    <br>
    <h2>Cuartos Disponibles</h2>
    <table>
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
                <th>Acción</th>
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
                        <td><button onclick='window.location.href=\"reservar.php?id={$row['id']}&usuario_id={$idUsuario}\"'>Reservar</button></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No hay cuartos disponibles actualmente.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
