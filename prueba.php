<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Desplegable</title>
    <style>
        /* Estilo del contenedor del menú */
        .contenedorOpciones {
            position: fixed;
            top: 0;
            right: -250px; /* Inicialmente fuera de la pantalla */
            width: 250px;
            height: 100%;
            background-color: #333;
            transition: right 0.3s ease;
            z-index: 1000;
        }

        /* Estilo del botón flotante */
        .BotonOpciones {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #333;
            color: white;
            border: none;
            font-size: 30px;
            padding: 10px;
            cursor: pointer;
            z-index: 1001; /* Asegurarse de que esté encima del menú */
        }

        /* Cuando el menú esté visible */
        .contenedorOpciones.mostrar {
            right: 0;
        }

        /* Estilo de la lista dentro del menú */
        .contenedorOpciones ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .contenedorOpciones ul li {
            padding: 15px;
            text-align: center;
        }

        .contenedorOpciones ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .contenedorOpciones ul li a:hover {
            background-color: #575757;
        }
    </style>
</head>
<body>

    <!-- Menú desplegable en un div -->
    <div>
        <div id="opciones" class="contenedorOpciones">
            <!-- Botón flotante -->
            <button id="toggleButton" class="BotonOpciones">☰</button>
            <ul>
                <!-- Servicios -->
                <li><a href="#inicio">¿Quiénes Somos?</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#precios">Precios</a></li>
                <li><a href="#contactanos">Contáctanos</a></li>
                <li><a href="#galeria">Galería</a></li>
                <li><a href="#reservacion">Reservación</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </div>
    </div>

    <!-- Secciones para el desplazamiento suave -->
    <section id="inicio" style="height: 100vh; background-color: lightgrey;">Inicio</section>
    <section id="servicios" style="height: 100vh; background-color: lightblue;">Servicios</section>
    <section id="precios" style="height: 100vh; background-color: lightgreen;">Precios</section>
    <section id="contactanos" style="height: 100vh; background-color: lightcoral;">Contáctanos</section>
    <section id="galeria" style="height: 100vh; background-color: lightskyblue;">Galería</section>
    <section id="reservacion" style="height: 100vh; background-color: lightyellow;">Reservación</section>
    <section id="contacto" style="height: 100vh; background-color: lightpink;">Contacto</section>

    <script>
        // Obtener el botón y el contenedor del menú
        const toggleButton = document.getElementById("toggleButton");
        const opcionesMenu = document.getElementById("opciones");

        // Función para mostrar u ocultar el menú
        toggleButton.addEventListener("click", function () {
            opcionesMenu.classList.toggle("mostrar");
        });

        // Manejar el scroll suave hacia las secciones
        document.querySelectorAll('.contenedorOpciones ul li a').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1); // Obtener el ID de la sección
                const targetSection = document.getElementById(targetId);

                // Desplazarse suavemente a la sección
                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 60, // Ajustar por la altura del header fijo
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
