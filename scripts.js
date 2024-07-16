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
const changeSlide = (carousel, increment) => {
  const carouselImages = carousel.querySelector(".carousel-images");
  let currentSlide = parseInt(carousel.dataset.currentSlide) || 0;
  const totalSlides = carouselImages.children.length / 2; // Número total de diapositivas únicas
  const slideWidth = carouselImages.children[0].clientWidth; // Ancho de cada diapositiva

  currentSlide = (currentSlide + increment + totalSlides) % totalSlides;
  carousel.dataset.currentSlide = currentSlide; // Actualiza el índice de la diapositiva actual

  const offset = -currentSlide * slideWidth; // Calcula el desplazamiento en píxeles
  carouselImages.style.transform = `translateX(${offset}px)`; // Aplica la transformación CSS para cambiar la diapositiva
};

// Función principal que se ejecuta cuando el DOM ha sido completamente cargado
document.addEventListener("DOMContentLoaded", () => {
  // Gestión de cookies
  checkCookieConsent();

  // Configuración del carrusel
  document.querySelectorAll(".carousel").forEach(carousel => {
    const carouselImages = carousel.querySelector(".carousel-images");
    const prevButton = carousel.querySelector(".prev");
    const nextButton = carousel.querySelector(".next");

    let currentSlide = 0; // Inicializa el índice de la diapositiva actual
    const totalSlides = carouselImages.children.length / 2; // Número total de diapositivas únicas
    const slideWidth = carouselImages.children[0].clientWidth; // Ancho de cada diapositiva

    // Clona las diapositivas para crear un bucle infinito
    for (let i = 0; i < totalSlides; i++) {
      const clone = carouselImages.children[i].cloneNode(true);
      carouselImages.appendChild(clone);
    }

    carousel.dataset.currentSlide = 0; // Inicializa el índice de la diapositiva actual en el dataset

    // Añade eventos a los botones de navegación
    prevButton.addEventListener("click", () => changeSlide(carousel, -1));
    nextButton.addEventListener("click", () => changeSlide(carousel, 1));
  });
});

