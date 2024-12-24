// Función para abrir el modal
function openModal() {
    const modal = document.getElementById("loginModal");
    modal.style.display = "block"; // Abrir el modal
}

// Función para cerrar el modal
function closeModal() {
    const modal = document.getElementById("loginModal");
    modal.style.display = "none"; // Cerrar el modal
}

// Función para manejar clic fuera del modal
function clickOutsideToClose(event) {
    const modal = document.getElementById("loginModal");
    if (event.target === modal) {
        closeModal();
    }
}

// Función para iniciar sesión
function handleLogin(event) {
    event.preventDefault(); // Evitar el envío del formulario

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    console.log("Usuario:", username);
    console.log("Contraseña:", password);

    closeModal(); // Cerrar el modal después del login
}

// Función para manejar clic en el botón de login
function handleLoginButtonClick() {
    openModal(); // Abrir el modal de login
}

// Función para cerrar el modal cuando se hace clic en la 'X'
function handleCloseButtonClick() {
    closeModal(); // Cerrar el modal
}

// Configurar los eventos
document.addEventListener("DOMContentLoaded", function() {
    // Obtener los elementos
    const btn = document.getElementById("loginButton");
    const closeBtn = document.getElementById("closeButton");
    const loginForm = document.getElementById("loginForm");

    // Asignar eventos a los elementos
    btn.addEventListener("click", handleLoginButtonClick);
    closeBtn.addEventListener("click", handleCloseButtonClick);
    loginForm.addEventListener("submit", handleLogin);
    window.addEventListener("click", clickOutsideToClose);
});
