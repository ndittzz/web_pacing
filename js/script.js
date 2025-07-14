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

// Replace the hamburger icon SVG in all HTML files with a more modern one (3 lines, rounded, animated if possible)
// Enhance sidebar active/hover color effect via JS and CSS class
// Add this helper for toggling active/hover color in sidebar

// Add hover/active effect for sidebar links
function updateSidebarActiveState() {
  const currentPath = window.location.pathname.split("/").pop();
  document.querySelectorAll("#mobile-menu a").forEach((link) => {
    const href = link.getAttribute("href");
    if (href === currentPath) {
      link.classList.add("bg-red-100", "text-red-700", "font-bold");
    } else {
      link.classList.remove("bg-red-100", "text-red-700", "font-bold");
    }
    link.addEventListener("mouseenter", function () {
      this.classList.add("bg-red-50", "text-red-700");
    });
    link.addEventListener("mouseleave", function () {
      if (href !== currentPath) {
        this.classList.remove("bg-red-50", "text-red-700");
      }
    });
  });
}

// Call after DOMContentLoaded and after menu open
function setupSidebarEnhancements() {
  updateSidebarActiveState();
}

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
    "profil.php",
    "visimisi.php",
    "sejarah.php",
    "struktur.php",
    "geografi.php",
  ];
  const informasiPages = ["berita.php", "galeri.php", "potensi.php"];
  const DatadesaPages = ["data_penduduk.php", "data_keuangan.php"];

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
  if (DatadesaPages.includes(currentPath)) {
    // Button Data Desa Desktop
    document.querySelectorAll("nav button").forEach((btn) => {
      if (btn.innerText.includes("Data Desa")) {
        btn.classList.add("text-red-700", "font-bold");
      }
    });

    // Summary Data Desa Mobile
    document.querySelectorAll("#mobile-menu summary").forEach((summary) => {
      if (summary.innerText.includes("Data Desa")) {
        summary.classList.add("text-red-700", "font-bold");
      }
    });
  }
  setupSidebarEnhancements();
});

// document
//   .getElementById("kategori-berita")
//   .addEventListener("change", function () {
//     const selectedUrl = this.value;
//     if (selectedUrl) {
//       window.location.href = selectedUrl;
//     }
//   });

document.addEventListener("DOMContentLoaded", () => {
  // Pasang listener ke SEMUA select yang butuh redirect
  document.querySelectorAll("[data-jump='page']").forEach((select) => {
    select.addEventListener("change", (e) => {
      const url = e.target.value;
      if (url) window.location.href = url;
    });
  });
});

function openModal(title, desc, imageUrl) {
  const modal = document.getElementById("popup-modal");
  const content = document.getElementById("popup-content");

  document.getElementById("popup-title").innerText = title;
  document.getElementById("popup-description").innerText = desc;
  document.getElementById("popup-image").src = imageUrl;

  modal.classList.remove("hidden");
  modal.classList.add("flex");
  content.classList.remove("modal-leave", "modal-leave-active");
  content.classList.add("modal-enter");
  setTimeout(() => {
    content.classList.add("modal-enter-active");
  }, 10);
}

function closeModal() {
  const modal = document.getElementById("popup-modal");
  const content = document.getElementById("popup-content");

  content.classList.remove("modal-enter", "modal-enter-active");
  content.classList.add("modal-leave");
  setTimeout(() => {
    content.classList.add("modal-leave-active");
    setTimeout(() => {
      modal.classList.add("hidden");
      modal.classList.remove("flex");
      content.classList.remove("modal-leave", "modal-leave-active");
    }, 200);
  }, 10);
}

// Navigasi klik berita ke detail_berita.php
document.querySelectorAll(".berita-link").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const id = this.getAttribute("data-id");
    window.location.href = `detail_berita.php?id=${id}`;
  });
});

// Navigasi klik potensi ke detail_potensi.php
document.querySelectorAll(".potensi-link").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const id = this.getAttribute("data-id");
    window.location.href = `detail_potensi.php?id=${id}`;
  });
});
