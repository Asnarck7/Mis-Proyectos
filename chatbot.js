document.addEventListener("DOMContentLoaded", () => {
    const chatbotPopup = document.getElementById("chatbotPopup");
    const openChatbot = document.getElementById("openChatbot");
    const closeChatbot = document.getElementById("closeChatbot");
    const chatbotForm = document.getElementById("chatbotForm");
    const chatbotMessages = document.getElementById("chatbotMessages");
    const chatbotInput = document.getElementById("chatbotInput");
  
    // Respuestas predefinidas
    const responses = {
      hola: "¡Hola! ¿En qué puedo ayudarte?",
      servicios: "Ofrecemos alojamiento, spa, restaurante y eventos. ¿Te interesa algo más específico?",
      precios: "Los precios de las habitaciones varían según la temporada. Contáctanos para más información.",
      reservacion: "Puedes realizar tu reservación en la sección de reservas de nuestra página web.",
      ubicacion: "Estamos ubicados en el corazón de Pijao, rodeados de montañas y naturaleza.",
      contacto: "Puedes contactarnos al teléfono 555-1234 o por correo electrónico en info@pijaodelsol.com.",
      gracias: "¡Gracias a ti por escribirnos! 😊",
      default: "Lo siento, no entiendo tu consulta. Por favor, intenta con otra pregunta relacionada con el hotel.",
    };
  
    // Mostrar el popup
    openChatbot.addEventListener("click", () => {
      chatbotPopup.style.display = "flex";
    });
  
    // Cerrar el popup
    closeChatbot.addEventListener("click", () => {
      chatbotPopup.style.display = "none";
    });
  
    // Manejo del formulario
    chatbotForm.addEventListener("submit", (event) => {
      event.preventDefault();
      const userMessage = chatbotInput.value.trim().toLowerCase();
      if (userMessage) {
        appendMessage(userMessage, "user-message");
        chatbotInput.value = "";
        respondToMessage(userMessage);
      }
    });
  
    // Agregar mensaje al chat
    function appendMessage(message, className) {
      const messageElement = document.createElement("p");
      messageElement.textContent = message;
      messageElement.className = className;
      chatbotMessages.appendChild(messageElement);
      chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }
  
    // Responder al mensaje
    function respondToMessage(userMessage) {
      const response = responses[userMessage] || responses.default;
      setTimeout(() => {
        appendMessage(response, "bot-message");
      }, 1000);
    }
  });
  