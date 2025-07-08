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

//popup
function showDetail(id) {
  document.getElementById(id).classList.remove("hidden");
  document.getElementById(id).classList.add("flex");
}

function hideDetail(id) {
  document.getElementById(id).classList.add("hidden");
  document.getElementById(id).classList.remove("flex");
}

const toggle = document.getElementById("menu-toggle");
const menu = document.getElementById("mobile-menu");

toggle.addEventListener("click", () => {
  menu.classList.toggle("hidden");
});

document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname.split("/").pop();

  // 🔴 Menu Desktop
  document.querySelectorAll("nav a").forEach((link) => {
    const href = link.getAttribute("href");
    if (href === currentPath) {
      link.classList.add("text-red-700", "font-bold");
    }
  });

  // 🔴 Menu Mobile
  document.querySelectorAll("#mobile-menu a").forEach((link) => {
    const href = link.getAttribute("href");
    if (href === currentPath) {
      link.classList.add("text-red-700", "font-bold");
    }
  });

  // 🔴 Khusus Profil Dropdown — tandai sebagai aktif juga jika termasuk sub-halaman
  const profilPages = [
    "profil.html",
    "visimisi.html",
    "sejarah.html",
    "struktur.html",
    "geografi.html",
  ];
  const informasiPages = ["berita.html", "galeri.html", "potensi.html"];
  if (profilPages.includes(currentPath)) {
    // Button Profil Desktop
    document.querySelectorAll("nav button").forEach((btn) => {
      if (btn.innerText.includes("Profil")) {
        btn.classList.add("text-red-700", "font-bold");
      }
    });

    // Summary Profil Mobile
    document.querySelectorAll("#mobile-menu summary").forEach((summary) => {
      if (summary.innerText.includes("Profil")) {
        summary.classList.add("text-red-700", "font-bold");
      }
    });
  }
  if (informasiPages.includes(currentPath)) {
    // Button Informasi Desktop
    document.querySelectorAll("nav button").forEach((btn) => {
      if (btn.innerText.includes("Informasi")) {
        btn.classList.add("text-red-700", "font-bold");
      }
    });

    // Summary Informasi Mobile
    document.querySelectorAll("#mobile-menu summary").forEach((summary) => {
      if (summary.innerText.includes("Informasi")) {
        summary.classList.add("text-red-700", "font-bold");
      }
    });
  }
});

document
  .getElementById("kategori-berita")
  .addEventListener("change", function () {
    const selectedUrl = this.value;
    if (selectedUrl) {
      window.location.href = selectedUrl;
    }
  });
