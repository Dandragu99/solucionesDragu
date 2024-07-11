// Función para establecer una cookie
const setCookie = (name, value, days) => {
  const expires = new Date();
  expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
};

// Función para obtener el valor de una cookie
const getCookie = (name) => {
  const cookieValue = document.cookie.match(`(^|;)\\s*${name}\\s*=\\s*([^;]+)`);
  return cookieValue ? cookieValue.pop() : null;
};

// Función para aceptar las cookies
const acceptCookies = () => {
  setCookie("cookieConsent", "accepted", 30); // Establece una cookie "cookieConsent" que expira en 30 días
  const cookieConsentElement = document.getElementById("cookieConsent");
  if (cookieConsentElement) {
      cookieConsentElement.style.display = "none"; // Oculta el mensaje de cookies
  }
};

// Función para revocar el consentimiento de las cookies
const revokeCookies = () => {
  document.cookie = "cookieConsent=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"; // Elimina la cookie "cookieConsent"
  const cookieConsentElement = document.getElementById("cookieConsent");
  if (cookieConsentElement) {
      cookieConsentElement.style.display = "block"; // Muestra nuevamente el mensaje de cookies
  }
};

// Función para comprobar si se ha aceptado el consentimiento de cookies
const checkCookieConsent = () => {
  const cookieConsent = getCookie("cookieConsent");
  if (cookieConsent === "accepted") {
      const cookieConsentElement = document.getElementById("cookieConsent");
      if (cookieConsentElement) {
          cookieConsentElement.style.display = "none"; // Oculta el mensaje de cookies si ya se ha aceptado
      }
  }
};

// Función para cambiar la diapositiva del carrusel
const changeSlide = (increment, totalSlides, currentSlide, slideWidth, carouselImages) => {
  currentSlide = (currentSlide + increment + totalSlides) % totalSlides;
  const offset = -currentSlide * slideWidth; // Calcula el desplazamiento en píxeles
  carouselImages.style.transform = `translateX(${offset}px)`; // Aplica la transformación CSS para cambiar la diapositiva
};

// Función principal que se ejecuta cuando el DOM ha sido completamente cargado
document.addEventListener("DOMContentLoaded", () => {
  // Gestión de cookies
  checkCookieConsent();

  // Configuración del carrusel
  const container = document.querySelector(".container");
  if (container) {
    const carousel = container.querySelector(".carousel");
    const carouselImages = carousel.querySelector(".carousel-images");
    const prevButton = carousel.querySelector(".prev");
    const nextButton = carousel.querySelector(".next");

    let currentSlide = 0; // Inicializa el índice de la diapositiva actual
    const totalSlides = carouselImages.children.length; // Número total de diapositivas
    const slideWidth = carouselImages.children[0].clientWidth; // Ancho de cada diapositiva

    // Clona las diapositivas para crear un bucle infinito
    for (let i = 0; i < totalSlides; i++) {
      const clone = carouselImages.children[i].cloneNode(true);
      carouselImages.appendChild(clone);
    }

    // Añade eventos a los botones de navegación
    prevButton.addEventListener("click", () => changeSlide(-1, totalSlides, currentSlide, slideWidth, carouselImages));
    nextButton.addEventListener("click", () => changeSlide(1, totalSlides, currentSlide, slideWidth, carouselImages));
  }
});
