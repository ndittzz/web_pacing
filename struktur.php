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
            <li class="relative group active">
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
                <a href="#" class="block px-4 py-2 hover:bg-gray-100"
                  >Data Penduduk</a
                >
                <a href="#" class="block px-4 py-2 hover:bg-gray-100"
                  >Data Keuangan</a
                >
              </div>
            </li>

            <li class="relative group">
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
              <span class="text-gray-500">Profil</span>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
              <span class="text-gray-700 font-semibold"
                >Struktur Pemerintah Desa Pacing</span
              >
            </div>
          </li>
        </ol>
      </nav>
    </section>

    <!-- Main content grid -->
    <main
      class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-6 grid grid-cols-1 lg:grid-cols-4 gap-6"
    >
      <div class="w-full sm:w-48">
        <select
          id="kategori-profil"
          data-jump="page"
          aria-label="Pilih kategori berita"
          class="w-full border border-gray-300 rounded-md text-xs sm:text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-700"
        >
          <option value="" disabled selected>Pilih Kategori</option>
          <option value="struktur.php">Pemerintah</option>
          <option value="pemerintahan.php">Pemerintahan</option>
        </select>
      </div>
      <section
        class="col-span-1 lg:col-span-4 bg-white rounded-lg shadow border border-gray-200 p-6"
      >
        <h1
          class="text-center text-2xl sm:text-3xl font-bold text-red-800 border-b-2 border-red-800 pb-2 mb-6"
        >
          Struktur Organisasi Pemerintah Desa Pacing
        </h1>
        <div class="bg-gray-50 rounded-lg p-6 mb-6 text-justify">
          Berikut adalah struktur organisasi Pemerintah Desa Pacing, Kecamatan
          Wedi, Kabupaten Klaten, Jawa Tengah. Struktur ini menggambarkan
          susunan perangkat desa beserta tugas dan fungsinya dalam mendukung
          pelayanan kepada masyarakat.
        </div>
        <div class="flex flex-col items-center">
          <img
            src="assets/StrukturDesa.drawio1.png"
            alt="Struktur Organisasi Desa Pacing"
            class="w-full max-w-2xl border rounded shadow mb-3 bg-white"
          />
          <span class="text-xs text-gray-500"
            >Gambar: Struktur Organisasi Pemerintah Desa Pacing</span
          >
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white text-xs sm:text-sm mt-10">
      <div
        class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-6 grid grid-cols-1 md:grid-cols-3 gap-6"
      >
        <div>
          <h4 class="font-semibold mb-2">Desa Pacing</h4>
          <h5 class="font-semibold mb-1">Kebijakan Privasi</h5>
          <address class="not-italic mb-1">
            Alamat
            <br />
            Jl. Pemuda No. 294 57424
          </address>
          <p class="mb-1">
            Telepon
            <br />
            <a class="hover:underline" href="tel:0272321046"> 0272-321046 </a>
          </p>
          <p>
            Email
            <br />
            <a class="hover:underline" href="mailto:pemkab@pacing.go.id">
              pemkab@pacing.go.id
            </a>
          </p>
        </div>
        <div>
          <h4 class="font-semibold mb-2">Statistik Pengunjung</h4>
          <p>
            Pengunjung Hari ini :
            <strong> 96 Pengunjung </strong>
            <br />
            Kemarin :
            <strong> 137 Pengunjung </strong>
            <br />
            Bulan ini :
            <strong> 919 Pengunjung </strong>
            <br />
            Tahun ini :
            <strong> 9723 Pengunjung </strong>
            <br />
            Total :
            <strong> 21559 Pengunjung </strong>
          </p>
        </div>
        <div>
          <h4 class="font-semibold mb-2">Sosial Media</h4>
          <ul class="space-y-1">
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
      <div
        class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-2 border-t border-gray-700 flex justify-between text-[10px] sm:text-xs"
      >
        <p>©Copyright Desa Pacing</p>
        <p>Dibuat Oleh Desa Pacing</p>
      </div>
    </footer>
  </body>
  <script src="js/script.js"></script>
</html>
