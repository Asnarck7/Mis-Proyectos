// Obtener el botón y el contenedor del menú
const toggleButton = document.getElementById("toggleButton");
const opcionesMenu = document.getElementById("opciones");

// Función para mostrar u ocultar el menú
toggleButton.addEventListener("click", function() {
    opcionesMenu.classList.toggle("mostrar");
});

// Manejar el scroll suave hacia las secciones
document.querySelectorAll('nav ul li a').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1); // Obtener el ID de la sección
        const targetSection = document.getElementById(targetId);

        // Desplazarse suavemente a la sección, ajustando la altura del header fijo
        window.scrollTo({
            top: targetSection.offsetTop - 60, // Compensa la altura del header fijo
            behavior: 'smooth'
        });
    });
});


