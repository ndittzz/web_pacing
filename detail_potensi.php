<?php
include 'php/db.php';
if (!isset($_GET['id'])) {
  echo '<h1>Data tidak ditemukan</h1>';
  exit;
}
$id = intval($_GET['id']);
$result = $konek->query("SELECT * FROM potensi WHERE id=$id");
if (!$result || $result->num_rows == 0) {
  echo '<h1>Data tidak ditemukan</h1>';
  exit;
}
$data = $result->fetch_assoc();
?>
<html class="scroll-smooth" lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Pemerintah Desa Pacing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"
    ></script>
    <link href="css/style.css" rel="stylesheet" />

    <style>
      body {
        font-family: "Inter", sans-serif;
      }
      /* Custom scrollbar for horizontal scroll containers */
      .scrollbar-hide::-webkit-scrollbar {
        display: none;
      }
      .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
    </style>
  </head>
  <body class="bg-white text-black">
    <!-- Top header with logo and nav -->
    <!-- Navbar dengan Dropdown -->
    <header class="border-b border-gray-200">
      <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <nav
          aria-label="Primary Navigation"
          class="flex items-center justify-between h-16 text-xs sm:text-sm font-semibold"
        >
          <div class="flex items-center space-x-2">
            <img
              alt="Logo Pemerintah Desa Pacing"
              class="block"
              height="32"
              src="assets/klaten.jpg"
              width="32"
            />
            <span class="text-red-800 text-base">Desa Pacing, Klaten</span>
          </div>

          <!-- Tombol Hamburger (Mobile & Small Desktop) -->
          <button
            id="menu-toggle"
            class="md:hidden text-red-800 focus:outline-none"
            aria-label="Buka menu"
          >
            <svg
              class="w-8 h-8"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <line x1="4" y1="7" x2="20" y2="7" />
              <line x1="4" y1="12" x2="20" y2="12" />
              <line x1="4" y1="17" x2="20" y2="17" />
            </svg>
          </button>

          <ul
            class="hidden md:flex items-center space-x-6 text-xs sm:text-sm font-semibold"
          >
            <li>
              <a class="hover:text-gray-700" href="index.php">Beranda</a>
            </li>
            <li class="relative group">
              <button
                class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none"
              >
                <span>Profil</span>
                <i class="fas fa-chevron-down text-[8px] mt-[2px]"></i>
              </button>
              <div
                class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 shadow-lg opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100 transition-all duration-300 origin-top z-50"
              >
                <a href="profil.php" class="block px-4 py-2 hover:bg-gray-100"
                  >Profil Pejabat</a
                >
                <a
                  href="visimisi.php"
                  class="block px-4 py-2 hover:bg-gray-100"
                  >Visi dan Misi</a
                >
                <a href="sejarah.php" class="block px-4 py-2 hover:bg-gray-100"
                  >Sejarah</a
                >
                <a
                  href="struktur.php"
                  class="block px-4 py-2 hover:bg-gray-100"
                  >Struktur</a
                >

                <a
                  href="geografi.php"
                  class="block px-4 py-2 hover:bg-gray-100"
                  >Geografi</a
                >
              </div>
            </li>
            <li class="relative group">
              <button
                class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none"
              >
                <span>Data Desa</span>
                <i class="fas fa-chevron-down text-[8px] mt-[2px]"></i>
              </button>
              <div
                class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 shadow-lg opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100 transition-all duration-300 origin-top z-50"
              >
                <a
                  href="data_penduduk.php"
                  class="block px-4 py-2 hover:bg-gray-100"
                  >Data Penduduk</a
                >
                <a
                  href="data_keuangan.php"
                  class="block px-4 py-2 hover:bg-gray-100"
                  >Data Keuangan</a
                >
              </div>
            </li>

            <li class="relative group active">
              <button
                class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none"
              >
                <span>Informasi</span>
                <i class="fas fa-chevron-down text-[8px] mt-[2px]"></i>
              </button>
              <div
                class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 shadow-lg opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100 transition-all duration-300 origin-top z-50"
              >
                <a href="berita.php" class="block px-4 py-2 hover:bg-gray-100"
                  >Berita</a
                >
                <a href="galeri.php" class="block px-4 py-2 hover:bg-gray-100"
                  >Galeri</a
                >
                <a href="potensi.php" class="block px-4 py-2 hover:bg-gray-100"
                  >Potensi</a
                >
              </div>
            </li>
            <li>
              <a
                href="admin/login.php"
                class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-900 transition duration-300"
              >
                Login Admin
              </a>
            </li>
          </ul>
        </nav>
        <!-- Menu Mobile/Sidebar -->
        <div
          id="mobile-menu"
          class="md:hidden hidden px-4 pt-4 pb-6 bg-white border-t border-gray-200 shadow-sm space-y-4 text-sm font-semibold text-gray-700 animate-fade-in"
        >
          <a
            href="index.php"
            class="block px-2 py-2 rounded hover:bg-red-50 hover:text-red-700 transition"
            >Beranda</a
          >

          <!-- Profil -->
          <details class="group">
            <summary
              class="cursor-pointer px-2 py-2 rounded hover:bg-red-50 hover:text-red-700 transition"
            >
              Profil
            </summary>
            <div class="pl-4 mt-1 space-y-1 text-sm text-gray-600">
              <a
                href="profil.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Profil Pejabat</a
              >
              <a
                href="visimisi.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Visi dan Misi</a
              >
              <a
                href="sejarah.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Sejarah</a
              >
              <a
                href="struktur.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Struktur</a
              >

              <a
                href="geografi.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Geografi</a
              >
            </div>
          </details>

          <!-- PPID -->
          <details class="group">
            <summary
              class="cursor-pointer px-2 py-2 rounded hover:bg-red-50 hover:text-red-700 transition"
            >
              Data Desa
            </summary>
            <div class="pl-4 mt-1 space-y-1 text-sm text-gray-600">
              <a
                href="data_penduduk.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Data Penduduk</a
              >
              <a
                href="data_keuangan.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Data Keuangan</a
              >
            </div>
          </details>

          <!-- Informasi -->
          <details class="group">
            <summary
              class="cursor-pointer px-2 py-2 rounded hover:bg-red-50 hover:text-red-700 transition"
            >
              Informasi
            </summary>
            <div class="pl-4 mt-1 space-y-1 text-sm text-gray-600">
              <a
                href="berita.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Berita</a
              >
              <a
                href="galeri.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Galeri</a
              >
              <a
                href="potensi.php"
                class="block px-2 py-1 rounded hover:bg-gray-100"
                >Potensi</a
              >
            </div>
          </details>

          <a
            href="admin/login.php"
            class="block mt-2 px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 transition"
          >
            Login Admin
          </a>
        </div>
      </div>
    </header>
    <!-- Search bar and category select -->
    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-4">
      <div
        class="flex flex-col sm:flex-row items-center sm:items-stretch gap-3 sm:gap-4"
      >
        <!-- Select Kategori -->
        <div class="w-full sm:w-48">
          <select
            id="kategori-berita"
            data-jump="page"
            aria-label="Pilih kategori berita"
            class="w-full border border-gray-300 rounded-md text-xs sm:text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-700"
          >
            <option value="" disabled selected>Pilih Kategori</option>
            <option value="pengumuman.php">Pengumuman</option>
            <option value="agenda.php">Agenda</option>
          </select>
        </div>

        <!-- Form Pencarian -->
        <form
          aria-label="Cari berita"
          class="flex flex-grow sm:flex-row w-full"
          role="search"
        >
          <input
            aria-label="Cari berita"
            class="flex-grow border border-gray-300 rounded-l-md text-xs sm:text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-700"
            placeholder="Cari berita yang Anda butuhkan . . ."
            type="search"
          />
          <button
            aria-label="Cari"
            class="bg-red-700 hover:bg-red-900 text-white text-xs sm:text-sm font-semibold px-4 rounded-r-md flex items-center justify-center"
            type="submit"
          >
            <i class="fas fa-search mr-1"></i>
            Cari
          </button>
        </form>
      </div>
    </section>

    <!-- Breadcrumb -->
    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-4">
      <nav
        class="flex text-xs sm:text-sm text-gray-600"
        aria-label="Breadcrumb"
      >
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="index.php" class="text-red-700 hover:text-red-800">
              <i class="fas fa-home mr-1"></i>
              Beranda
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
              <span class="text-gray-500">Informasi</span>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
              <a
                href="potensi.php"
                class="text-red-700 hover:text-red-800 font-semibold"
              >
                Potensi
              </a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
              <span class="text-gray-700 font-semibold">Detail Potensi</span>
            </div>
          </li>
        </ol>
      </nav>
    </section>

    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-6">
      <h1 class="text-2xl font-bold text-red-800 mb-4">
        <?php echo htmlspecialchars($data['judul']); ?>
      </h1>
      <img
        alt="<?php echo htmlspecialchars($data['judul']); ?>"
        class="w-full max-h-[500px] object-contain rounded-md mb-4 mx-auto bg-gray-100"
        src="assets/<?php echo htmlspecialchars($data['gambar']); ?>"
      />
      <p class="text-sm text-gray-500 mb-4">
        <i class="fas fa-calendar-alt mr-1"></i>
        Dipublikasikan pada: <?php echo date('j M Y', strtotime($data['tanggal'])); ?> oleh <?php echo htmlspecialchars($data['penulis']); ?>
      </p>
      <div class="text-sm sm:text-base text-gray-700 space-y-3 mb-6">
        <?php echo nl2br(htmlspecialchars($data['deskripsi'])); ?>
      </div>
      <div class="mb-6">
        <a href="potensi.php" class="inline-flex items-center px-4 py-2 bg-red-700 text-white rounded hover:bg-red-900 text-sm">
          <i class="fas fa-arrow-left mr-2"></i> Kembali ke Potensi
        </a>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white text-xs sm:text-sm mt-10">
      <!-- Konten Utama: 3 Kolom -->
      <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Kolom Kiri -->
        <div class="text-center">
          <h4 class="font-semibold text-base mb-2">Desa Pacing</h4>
          <address class="not-italic leading-relaxed mb-3">
            Dusun I, Pacing, Kec. Wedi,<br />
            Kabupaten Klaten, Jawa Tengah 57461
          </address>
          <p class="mb-1">
            <span class="font-semibold">Telepon:</span><br />
            <a class="hover:underline" href="tel:0272-321046">0272-321046</a>
          </p>
        </div>

        <!-- Kolom Tengah -->
        <div class="text-center">
          <h4 class="font-semibold text-base mb-2">Tentang Kami</h4>
          <p class="mb-3">Website resmi Desa Pacing sebagai pusat informasi, pelayanan, dan komunikasi masyarakat desa.</p>
          <p class="mb-1">Silakan hubungi kami untuk pertanyaan, saran, atau kolaborasi.</p>
        </div>

        <!-- Kolom Kanan -->
        <div class="text-center">
          <h4 class="font-semibold text-base mb-2">Sosial Media</h4>
          <ul class="space-y-2">
            <li>
              <a href="mailto:desapacingklaten@gmail.com" class="hover:underline">
                <i class="fas fa-envelope mr-1"></i> desapacingklaten@gmail.com
              </a>
            </li>
            <li>
              <a href="https://instagram.com/desapacingg" target="_blank" class="hover:underline">
                <i class="fab fa-instagram mr-1"></i> @desapacingg
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Footer Bawah -->
      <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-4 border-t border-gray-700 flex flex-col sm:flex-row justify-between items-center text-[10px] sm:text-xs space-y-2 sm:space-y-0">
        <p>© 2025 Desa Pacing. All rights reserved.</p>
        <p>Dibuat oleh <span class="font-semibold">Desa Pacing</span></p>
      </div>
    </footer>

    <script>
      // Mobile menu toggle
      document
        .getElementById("menu-toggle")
        .addEventListener("click", function () {
          const menu = document.getElementById("mobile-menu");
          menu.classList.toggle("hidden");
        });

      // Category selector
      document
        .getElementById("kategori-berita")
        .addEventListener("change", function () {
          if (this.value) {
            window.location.href = this.value;
          }
        });
    </script>
  </body>
</html>
