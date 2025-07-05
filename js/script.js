// Slider Banner
let currentSlide = 0;
const slides = document.querySelectorAll("#banner-slider .slide");
const dots = document.querySelectorAll("#dots button");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.style.opacity = i === index ? "1" : "0";
  });
  dots.forEach((dot, i) => {
    dot.classList.toggle("bg-red-800", i === index);
    dot.classList.toggle("bg-gray-300", i !== index);
  });
  currentSlide = index;
}

function nextSlide() {
  const next = (currentSlide + 1) % slides.length;
  showSlide(next);
}

function prevSlide() {
  const prev = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(prev);
}

function goToSlide(index) {
  showSlide(index);
}

// Auto-slide every 5 seconds
setInterval(nextSlide, 5000);

// Initialize
showSlide(0);
