<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Hotel Paraíso - Tu destino de lujo y confort." />
  <link rel="stylesheet" href="css/EstiloPaginaWeb.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <script src="javascript.js" defer></script>
  <script src="script.js" defer></script>
  <link rel="stylesheet" href="css/StyleChat/chatbot.css">
  <script src="chatbot.js" defer></script>




  <title>Hotel Pijao Del Sol</title>
</head>

<body>
  <header>
    <div>
      <!-- Menú desplegable -->
      <div id="opciones" class="contenedorOpciones">
        <button id="toggleButton" class="BotonOpciones">☰</button>
        <ul>
          <li><a href="#inicio">¿Quiénes Somos?</a></li>
          <li><a href="#servicios">Servicios</a></li>
          <li><a href="#precios">Precios</a></li>
          <li><a href="#contactanos">Contáctanos</a></li>
          <li><a href="#galeria">Galería</a></li>
          <li><a href="#reservacion">Reservación</a></li>
          <li><a href="#contacto">Contacto</a></li>
          <li><a href="#SeccionDelchatbot">ChatBot</a></li>
        </ul>
      </div>
    </div>

    <!-- Botón Login -->
    <button class="botonLogin" id="loginButton">Login<span></span><span></span><span></span><span></span></button>
    
    <!-- Modal del login -->
    <div id="loginModal" class="modal">
      <div class="modal-content">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm">
          <span class="close" id="closeButton">&times;</span>

          <!-- Botones -->
          <a href="loginCliente/login.php" class="botonIniciar">Iniciar Sesión</a>
          <br>
          <a href="crearCuenta/crearClientes.php" class="botoncrear">Crear Cuenta</a>
          <br>
          <a href="crearCuenta/empleados/indexEmpleados.php" class="botonempleados">Empleados</a>
          <br>
        </form>
      </div>
    </div>

    <div>
      <img src="Imagenes/LogoPijao.png" class="logo" alt="LogoHotel" />
      <h1>Hotel Pijao Del Sol</h1>
      <h3>🛎💠 En el Tolima hay Hospitalidad cálida en cada rincón 🛎💠</h3>
      <br />
      <nav>
        <ul>
          <li><a href="#inicio">¿Quienes Somos?</a></li>
          <li><a href="#servicios">Servicios</a></li>
          <li><a href="#precios">Precios</a></li>
          <li><a href="#contactanos">Contactanos</a></li>
          <li><a href="#galeria">Galería</a></li>
          <li><a href="#reservación">Reservación</a></li>
          <li><a href="#contacto">Contacto</a></li>
        </ul>
      </nav>
    </div>
  </header>


  <!-- Sección de Bienvenida -->
  <section id="inicio">
    <br>
    <br>
    <br>
    <div class="sectionInicio">
      <br>
      <br><br><br>
      <h2>
        Hotel Pijao Del Sol: Un ícono de la hospitalidad en el corazón del
        Tolima
      </h2>
      <p>
        Fundado en el año 2003, el Hotel Pijao Del Sol se ha convertido en un
        referente de hospitalidad y confort en el cálido departamento del
        Tolima. Situado estratégicamente en una región privilegiada, el hotel
        ofrece a sus visitantes la oportunidad de disfrutar de impresionantes
        vistas panorámicas que capturan la esencia del clima cálido y la belleza
        natural de esta tierra. Desde su creación, ha sido un lugar ideal tanto
        para viajeros de negocios como para turistas en busca de relajación y
        conexión con la naturaleza.
      </p>
      <p>
        Las impresionantes vistas del sol tolimeño, especialmente al amanecer y
        al atardecer, son un espectáculo que complementa perfectamente la
        experiencia de alojamiento.
      </p>
      <br />
      <img src="Imagenes/vistas al sol.webp" class="fachada" alt="fachada-1704375981" />
      <br />
    </div>
  </section>

  <!-- Sección de Servicios -->
  <section id="servicios">
    <h2>Nuestros Servicios</h2>

    <!-- Sección Habitaciones -->
    <h3>🟤 Habitaciones</h3>
    <div class="servicios-grid">
      <div class="servicio-item">
        <img src="Imagenes/Habitaciones/Vip.avif" class="ImagenServicio" alt="Habitación VIP" />
        <p>Habitación VIP</p>
      </div>
      <div class="servicio-item">
        <img src="Imagenes/Habitaciones/siutJ.avif" class="ImagenServicio" alt="Habitación Junior Suite" />
        <p>Habitación Junior Suite</p>
      </div>
      <div class="servicio-item">
        <img src="Imagenes/Habitaciones/normal.avif" class="ImagenServicio" alt="Suite Especial" />
        <p>Suite Especial</p>
      </div>
      <div class="servicio-item">
        <img src="Imagenes/Habitaciones/familiar.jpg" class="ImagenServicio" alt="familiar" />
        <p>Suit Familiar</p>
      </div>
    </div>

    <!-- Sección Pasatiempos -->
    <h3>🟤 Pasatiempos</h3>
    <div class="servicios-grid">
      <div class="servicio-item">
        <img src="Imagenes/spaT.avif" class="ImagenServicio" alt="Spa" />
        <p>Spa</p>
      </div>
      <div class="servicio-item">
        <img src="Imagenes/Gimnasio.jpg" class="ImagenServicio" alt="Gimnasio" />
        <p>Gimnasio</p>
      </div>
      <div class="servicio-item">
        <p>Restaurante gourmet con cocina internacional</p>
      </div>
      <div class="servicio-item">
        <p>Salones para eventos y conferencias</p>
      </div>
    </div>
    <br>
  </section>
  <section id="precios">
    <br>
    <h2>Precios</h2>
    <ul>
      <li><strong>Suites:</strong> Un lujo exclusivo con vistas espectaculares, baño privado y una cama king-size para
        máxima comodidad. <strong>$650,000 COP</strong></li>
      <li><strong>Habitaciones CIP:</strong> Diseño moderno y elegante, ideal para viajeros de negocios, con espacio de
        trabajo y todas las comodidades necesarias. <strong>$350,000 COP</strong></li>
      <li><strong>Habitación Standard:</strong> Espaciosa y acogedora, equipada con cama doble, ideal para una estancia
        cómoda a un precio accesible. <strong>$200,000 COP</strong></li>
      <li><strong>Habitación Familiar:</strong> Perfecta para familias, con dos camas dobles y todo lo necesario para
        que tu estancia sea placentera. <strong>$500,000 COP</strong></li>
      <li><strong>Habitación Ejecutiva:</strong> Con un ambiente más formal y tranquilo, adecuada para quienes buscan
        descanso y trabajo en el mismo espacio. <strong>$400,000 COP</strong></li>
    </ul>

    <h1>Precios de Habitaciones</h1>
    <table class="tabla-precios">
      <thead>
        <tr>
          <th>Tipo de Habitación</th>
          <th>Número de Personas</th>
          <th>Precio por Noche (COP)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Suites</td>
          <td>2</td>
          <td>$650,000 COP</td>
        </tr>
        <tr>
          <td>Habitaciones CIP</td>
          <td>2</td>
          <td>$350,000 COP</td>
        </tr>
        <tr>
          <td>Habitación Standard</td>
          <td>2</td>
          <td>$200,000 COP</td>
        </tr>
        <tr>
          <td>Habitación Familiar</td>
          <td>4</td>
          <td>$500,000 COP</td>
        </tr>
        <tr>
          <td>Habitación Ejecutiva</td>
          <td>2</td>
          <td>$400,000 COP</td>
        </tr>
      </tbody>
    </table>
  </section>


  <section id="contactanos">
    <div class="form-container">
      <h2>¡Contáctanos! Estamos aquí para ayudarte</h2>
      <button type="button" class="submit-btn" onclick="window.location.href='contacto.php'">Enviar mensaje</button>
    </div>
  </section>

  <!-- Modal -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <p>¡Listo! Tu mensaje ha sido enviado correctamente.</p>
    </div>
  </div>



  <style>
    /* Estilos solo para la sección #contactanos */
    #contactanos {
      background-color: #f9f9f9;
      padding: 40px 0;
      font-family: Arial, sans-serif;
    }

    .form-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      font-size: 1.8rem;
      margin-bottom: 15px;
    }

    p {
      text-align: center;
      color: #7f8c8d;
      font-size: 1rem;
      margin-bottom: 30px;
    }

    .input-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 8px;
    }

    input,
    textarea {
      width: 100%;
      padding: 12px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      background-color: #f8f8f8;
      margin-bottom: 10px;
    }

    input:focus,
    textarea:focus {
      border-color: #3498db;
      outline: none;
    }

    textarea {
      resize: vertical;
    }

    button.submit-btn {
      width: 100%;
      padding: 14px;
      font-size: 1.1rem;
      color: white;
      background-color: #3498db;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    button.submit-btn:hover {
      background-color: #2980b9;
    }
  </style>


  <!-- Sección de Galería -->
  <section id="galeria">
    <h2>Galería</h2>
    <p>Explora imágenes de nuestras instalaciones:</p>
    <div>
      <img src="Imagenes/habitaciones.jpg" alt="Habitaciones de lujo" width="300" />
      <img src="Imagenes/restaurante.jpg" alt="Restaurante gourmet" width="300" />
      <img src="Imagenes/piscina.jpg" alt="Piscina al aire libre" width="300" />
    </div>
  </section>

  <!-- Reservacion -->
  <section id="reservación">
    <style>
      /* Estilos para el contenedor */
#reservación {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Hace que el contenedor ocupe toda la altura de la ventana */
}

/* Estilo del botón */
.btn-reservacion {
  background-color: #4CAF50; /* Verde */
  color: white;
  padding: 15px 40px; /* Aumenta el tamaño del botón */
  font-size: 24px; /* Tamaño de fuente */
  font-weight: bold; /* Texto en negrita */
  border: none;
  border-radius: 50px; /* Bordes redondeados */
  cursor: pointer; /* Cambia el cursor cuando pasa por encima */
  transition: all 0.3s ease; /* Transición suave */
  text-transform: uppercase; /* Texto en mayúsculas */
  letter-spacing: 1px; /* Espaciado entre letras */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Sombra sutil */
  position: relative;
  overflow: hidden; /* Oculta cualquier contenido que sobresalga */
}

/* Animación para el fondo del botón */
@keyframes glow {
  0% {
    background-color: #4CAF50;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  }
  50% {
    background-color: gold; /* Color oro */
    box-shadow: 0 0 20px 5px rgba(255, 215, 0, 0.8); /* Resplandor dorado */
  }
  100% {
    background-color: #4CAF50;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  }
}

/* Animación de brillo y expansión al hacer hover */
.btn-reservacion:hover {
  color: black; /* Cambia el texto a negro */
  animation: glow 1.5s ease-in-out infinite, expand 0.5s ease-out forwards; /* Aplica la animación de resplandor y expansión */
  transform: scale(1.1); /* Aumenta el tamaño del botón */
}

/* Expansión y contracción del botón */
@keyframes expand {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}

/* Efecto al hacer clic */
.btn-reservacion:active {
  transform: scale(1); /* Restaura el tamaño */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Restaura la sombra */
  animation: none; /* Elimina la animación cuando se hace clic */
}

    </style>

    <!-- Botón que realiza la reserva -->
    <button id="reservarBtn" class="btn-reservacion">Realizar Reservación</button>
    <script>
      // Manejador del clic en el botón de reservación
      document.getElementById("reservarBtn").addEventListener("click", function () {
        let isLoggedIn = localStorage.getItem("isLoggedIn"); // Verifica si el usuario está logueado

        if (isLoggedIn === "true") {
          alert("Reserva realizada exitosamente.");
          // Aquí puedes redirigir a una página de confirmación o abrir otro modal si es necesario.
        } else {
          alert("Por favor Cliente, inicie sesión para realizar la reservación.");
          alert("si no la tienes puedes crear una Cuenta.");
          // Abre el modal de login si no está logueado
          document.getElementById("loginModal").style.display = "flex";
        }
      });

      // Manejador del clic en el botón de cerrar modal
      document.getElementById("closeButton").addEventListener("click", function () {
        document.getElementById("loginModal").style.display = "none"; // Cierra el modal
      });

      // Cerrar el modal si el usuario hace clic fuera del modal
      window.addEventListener("click", function (event) {
        if (event.target === document.getElementById("loginModal")) {
          document.getElementById("loginModal").style.display = "none"; // Cierra el modal si se hace clic fuera
        }
      });
    </script>

  </section>


  <!-- Sección de Contacto -->
  <section id="contacto">
    <h2>Contacto</h2>
    <p>¿Tienes alguna pregunta o deseas hacer una reserva? Contáctanos:</p>
    <p>
      <strong>Correo:</strong>
      <a href="mailto:reservas@hotelparaiso.com">reservas@hotelparaiso.com</a>
    </p>
    <p>
      <strong>Teléfono:</strong> <a href="tel:+1234567890">123-456-7890</a>
    </p>
    <p><strong>Dirección:</strong> Calle Ejemplo #123, Ciudad Paraíso</p>
  </section>


<!-- Chatbot -->
<div class="chatbot-container">
    <!-- Imagen del Chatbot -->
    <button class="chatbot-toggle" id="openChatbot">
        <img src="Imagenes/CerdirtoChatBot.png" alt="Abrir Chatbot" style="width: 50px; height: 50px;" />
    </button>

    <!-- Ventana emergente del Chatbot -->
    <div class="chatbot-popup" id="chatbotPopup">
      <div class="chatbot-header">
        <h3>Asistente Piggi</h3>
        <button class="chatbot-close" id="closeChatbot">&times;</button>
      </div>
      <div class="chatbot-body" id="chatbotBody">
        <div class="chatbot-messages" id="chatbotMessages">
          <p class="bot-message">¡Hola! Bienvenido a Hotel Pijao del Sol. ¿En qué puedo ayudarte?</p>
        </div>
        <form id="chatbotForm">
          <input type="text" id="chatbotInput" placeholder="Escribe tu mensaje..." autocomplete="off" />
          <button type="submit">Enviar</button>
        </form>
      </div>
    </div>
</div>






  <!-- Pie de página -->
  <footer>
    <p>&copy; 2024 Hotel Paraíso. Todos los derechos reservados.</p>
    <p>
      Síguenos en nuestras redes sociales:
      <a href="https://www.facebook.com" target="_blank">Facebook</a> |
      <a href="https://www.instagram.com" target="_blank">Instagram</a> |
      <a href="https://www.twitter.com" target="_blank">Twitter</a>
    </p>
  </footer>

</body>

</html>