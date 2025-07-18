<?php
include 'php/db.php';
$result = $konek->query("SELECT * FROM galeri ORDER BY tanggal DESC LIMIT 9");
$result2 = $konek->query("SELECT * FROM berita ORDER BY tanggal DESC LIMIT 9");
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
            <li class="active">
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

    <!-- Banner slider -->
    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-4">
      <div
        id="banner-slider"
        class="relative rounded-lg overflow-hidden shadow-md"
      >
        <!-- Slides -->
        <div class="relative w-full h-[150px] sm:h-[200px] lg:h-[400px]">
          <div
            class="absolute inset-0 transition-opacity duration-700 opacity-100 slide"
          >
            <img
              src="assets/slider1.jpg"
              alt="Slide 1"
              class="w-full h-full object-cover"
            />
          </div>
          <div
            class="absolute inset-0 transition-opacity duration-700 opacity-0 slide"
          >
            <img
              src="assets/slider2.jpg"
              alt="Slide 2"
              class="w-full h-full object-cover"
            />
          </div>
          <!-- <div
            class="absolute inset-0 transition-opacity duration-700 opacity-0 slide"
          >
            <img
              src="assets/slider3.jpg"
              alt="Slide 3"
              class="w-full h-full object-cover"
            />
          </div> -->
        </div>

        <!-- Navigation Arrows -->
        <button
          onclick="prevSlide()"
          class="absolute top-1/2 left-3 -translate-y-1/2 bg-white/70 hover:bg-white text-black p-2 rounded-full shadow"
        >
          &#10094;
        </button>
        <button
          onclick="nextSlide()"
          class="absolute top-1/2 right-3 -translate-y-1/2 bg-white/70 hover:bg-white text-black p-2 rounded-full shadow"
        >
          &#10095;
        </button>

        <!-- Dots -->
        <div
          class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-2 z-10"
          id="dots"
        >
          <button
            onclick="goToSlide(0)"
            class="w-3 h-3 rounded-full bg-red-800"
          ></button>
          <button
            onclick="goToSlide(1)"
            class="w-3 h-3 rounded-full bg-gray-300"
          ></button>
          <!-- <button
            onclick="goToSlide(2)"
            class="w-3 h-3 rounded-full bg-gray-300"
          ></button> -->
        </div>
      </div>
    </section>
    <!-- Main content grid -->
    <main
      class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-6 grid grid-cols-1 lg:grid-cols-4 gap-6"
    >
      <!-- Left main content col-span-3 -->
      <section class="lg:col-span-3 space-y-8">
        <!-- Berita -->
        <section aria-labelledby="berita-title" class="space-y-4">
          <div class="flex justify-between items-center mb-2">
            <h2
              class="text-red-800 font-semibold text-base sm:text-lg border-b border-red-800 pb-0.5"
              id="berita-title"
            >
              Berita
            </h2>
            <a
              class="text-red-800 text-xs sm:text-sm font-semibold hover:underline flex items-center space-x-1"
              href="berita.php"
            >
              <span> Lihat Semua </span>
              <i class="fas fa-arrow-right text-[10px]"> </i>
            </a>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Berita item 1 -->
            <?php while ($row = $result2->fetch_assoc()): ?>
              <a href="detail_berita.php?id=<?php echo $row['id']; ?>" class="block hover:shadow-lg transition">
                <article
                  aria-label="Berita 1"
                  class="bg-white rounded-lg shadow-md p-3 flex flex-col"
                >
                  <img
                    alt="<?php echo htmlspecialchars($row['judul']); ?>"
                    class="rounded-md mb-2 object-cover w-full h-40 sm:h-36"
                    height="200"
                    loading="lazy"
                    src="assets/<?php echo htmlspecialchars($row['gambar']); ?>"
                    width="400"
                  />
                  <h3 class="font-semibold text-xs sm:text-sm mb-1 leading-tight">
                    <?php echo htmlspecialchars($row['judul']); ?>
                  </h3>
                  <div
                    class="flex items-center text-gray-600 text-[10px] sm:text-xs mb-1 space-x-1"
                  >
                    <i class="fas fa-user-circle"> </i>
                    <span> <?php echo htmlspecialchars($row['penulis']); ?> </span>
                  </div>
                  <p
                    class="text-gray-600 text-[9px] sm:text-xs mb-2 line-clamp-3"
                  >
                    <?php echo htmlspecialchars(mb_strimwidth(strip_tags($row['deskripsi']), 0, 120, '...')); ?>
                  </p>
                  <time
                    class="text-gray-400 text-[9px] sm:text-xs"
                    datetime="2025-07-03"
                  >
                    <?php echo date('j M, Y', strtotime($row['tanggal'])); ?>
                  </time>
                </article>
            </a>
            <?php endwhile; ?>
          </div>
        </section>
        <!-- Galeri -->
        <section aria-labelledby="galeri-title" class="space-y-4">
          <div class="flex justify-between items-center mb-2">
            <h2
              class="text-red-800 font-semibold text-base sm:text-lg border-b border-red-800 pb-0.5"
              id="galeri-title"
            >
              Galeri
            </h2>
            <a
              class="text-red-800 text-xs sm:text-sm font-semibold hover:underline flex items-center space-x-1"
              href="galeri.php"
            >
              <span> Lihat Semua </span>
              <i class="fas fa-arrow-right text-[10px]"> </i>
            </a>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <?php while ($row = $result->fetch_assoc()): ?>
            <article
              onclick="openModal(
                '<?php echo htmlspecialchars($row['judul']); ?>',
                '<?php echo htmlspecialchars($row['deskripsi']); ?>',
                'assets/<?php echo htmlspecialchars($row['gambar']); ?>'
              )"
              class="bg-white rounded-lg shadow-md p-2 flex flex-col cursor-pointer hover:ring-2 hover:ring-red-500 transition-all"
            >
              <img
                alt="Kirab Gunungan"
                class="rounded-md mb-2 object-cover w-full h-36"
                src="assets/<?php echo htmlspecialchars($row['gambar']); ?>"
                loading="lazy"
              />
              <h3 class="font-semibold text-xs sm:text-sm leading-tight">
                <?php echo htmlspecialchars($row['judul']); ?>
              </h3>
            </article>
          <?php endwhile; ?>
          </div>
        </section>
        <!-- Video -->
        <!-- <section aria-labelledby="video-title" class="space-y-4">
          <div class="flex justify-between items-center mb-2">
            <h2
              class="text-red-800 font-semibold text-base sm:text-lg border-b border-red-800 pb-0.5"
              id="video-title"
            >
              Video
            </h2>
            <a
              class="text-red-800 text-xs sm:text-sm font-semibold hover:underline flex items-center space-x-1"
              href="#"
            >
              <span> Lihat Semua </span>
              <i class="fas fa-arrow-right text-[10px]"> </i>
            </a>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <article
              aria-label="Video 1"
              class="bg-white rounded-lg shadow-md p-3 flex flex-col"
            >
              <div
                class="bg-gray-100 rounded-md h-24 sm:h-28 mb-2 flex items-center justify-center text-gray-400 text-xs sm:text-sm"
              >
                Video Thumbnail Placeholder
              </div>
              <h3 class="font-semibold text-xs sm:text-sm mb-1 leading-tight">
                DISKOMINFO DESA PACING
              </h3>
              <p class="text-gray-600 text-[9px] sm:text-xs line-clamp-3">
                Rokok ilegal adalah rokok yang beredar di wilayah Indonesia,
                baik yang berasal dari produk dalam...
              </p>
            </article>
            <article
              aria-label="Video 2"
              class="bg-white rounded-lg shadow-md p-3 flex flex-col"
            >
              <div
                class="bg-gray-100 rounded-md h-24 sm:h-28 mb-2 flex items-center justify-center text-gray-400 text-xs sm:text-sm"
              >
                Video Thumbnail Placeholder
              </div>
              <h3 class="font-semibold text-xs sm:text-sm mb-1 leading-tight">
                DISKOMINFO DESA PACING
              </h3>
            </article>
            <article
              aria-label="Video 3"
              class="bg-white rounded-lg shadow-md p-3 flex flex-col"
            >
              <div
                class="bg-gray-100 rounded-md h-24 sm:h-28 mb-2 flex items-center justify-center text-gray-400 text-xs sm:text-sm"
              >
                Video Thumbnail Placeholder
              </div>
              <h3 class="font-semibold text-xs sm:text-sm mb-1 leading-tight">
                DISKOMINFO DESA PACING
              </h3>
              <p class="text-gray-600 text-[9px] sm:text-xs line-clamp-3">
                Rokok ilegal adalah rokok yang beredar di wilayah Indonesia,
                baik yang berasal dari produk dalam...
              </p>
            </article>
          </div>
        </section> -->
      </section>
      <!-- Right sidebar -->
      <aside class="space-y-6">
        <!-- Survei -->
        <!-- <section
          aria-labelledby="survei-title"
          class="bg-white rounded-md shadow-md p-4 text-center"
        >
          <h3
            class="text-xs sm:text-sm font-semibold mb-3 text-gray-900"
            id="survei-title"
          >
            Ayo Ikuti Survei Kepuasan Pelayanan Publik Desa Pacing
          </h3>
          <button
            class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold py-2 px-4 rounded-md w-full"
            type="button"
          >
            Ikuti Survei
          </button>
        </section> -->
        <!-- Pengumuman -->
        <section aria-labelledby="pengumuman-title" class="space-y-3">
          <h3
            class="bg-red-800 text-white text-xs sm:text-sm font-semibold px-3 py-1 rounded-t-md"
            id="pengumuman-title"
          >
            Pengumuman
          </h3>
          <div
            aria-label="Daftar pengumuman"
            class="bg-white rounded-b-md shadow-md p-3 space-y-3 max-h-[280px] overflow-y-auto text-xs sm:text-sm"
            tabindex="0"
          >
            <a
              href="detail_pengumuman.php"
              class="block hover:bg-gray-50 transition rounded-lg p-2"
            >
              <article class="flex space-x-2">
                <i class="fas fa-bullhorn text-red-800 mt-1"></i>
                <div>
                  <h4 class="font-semibold text-red-800 leading-tight">
                    Pengumuman Seleksi Calon Anggota Komisaris PT. Aneka Usaha
                    (Perseroda) Desa Pacing
                  </h4>
                  <div
                    class="flex items-center space-x-2 text-gray-600 text-[10px] sm:text-xs"
                  >
                    <span>
                      <i class="fas fa-user-circle"></i>
                      Admin
                    </span>
                    <span> 24 Apr, 2025 </span>
                  </div>
                  <p class="text-gray-600 line-clamp-3 mt-1">
                    Pemerintah Desa Pacing membutuhkan personil untuk jabatan
                    Dewan Komisaris pada PT. Aneka Usaha...
                  </p>
                </div>
              </article>
            </a>
          </div>
          <a
            class="text-red-800 text-xs sm:text-sm font-semibold hover:underline flex items-center justify-end space-x-1"
            href="pengumuman.php"
          >
            <span> Lihat Semua </span>
            <i class="fas fa-arrow-right text-[10px]"> </i>
          </a>
        </section>
        <!-- Agenda -->
        <section aria-labelledby="agenda-title" class="space-y-3">
          <h3
            class="bg-red-800 text-white text-xs sm:text-sm font-semibold px-3 py-1 rounded-t-md"
            id="agenda-title"
          >
            Agenda
          </h3>
          <div
            aria-label="Daftar agenda"
            class="bg-white rounded-b-md shadow-md p-3 space-y-3 max-h-[280px] overflow-y-auto text-xs sm:text-sm"
            tabindex="0"
          >
            <article class="flex space-x-3">
              <div
                class="text-red-800 font-semibold text-sm leading-none min-w-[30px]"
              >
                28
                <br />
                Jul
              </div>
              <div class="flex-grow">
                <h4 class="font-semibold leading-tight">
                  Upacara Hari Jadi ke-220 Desa Pacing
                </h4>
                <div class="flex items-center space-x-1 text-gray-600">
                  <i class="fas fa-calendar-alt text-[10px]"> </i>
                  <time class="text-[10px]" datetime="2024-07-28">
                    Tanggal 28 Jul, 2024
                  </time>
                </div>
                <div class="flex items-center space-x-1 text-gray-600">
                  <i class="fas fa-clock text-[10px]"> </i>
                  <time class="text-[10px]" datetime="2024-07-28T09:00">
                    Pukul 09:00 s/d 09:00
                  </time>
                </div>
              </div>
            </article>
            <article class="flex space-x-3">
              <div
                class="text-red-800 font-semibold text-sm leading-none min-w-[30px]"
              >
                28
                <br />
                Jul
              </div>
              <div class="flex-grow">
                <h4 class="font-semibold leading-tight">
                  Kirap Ageng Metil Bumi dan Tarian Kolosal Baro Klinthing
                  Merapi
                </h4>
                <div class="flex items-center space-x-1 text-gray-600">
                  <i class="fas fa-calendar-alt text-[10px]"> </i>
                  <time class="text-[10px]" datetime="2024-07-28">
                    Tanggal 28 Jul, 2024
                  </time>
                </div>
                <div class="flex items-center space-x-1 text-gray-600">
                  <i class="fas fa-clock text-[10px]"> </i>
                  <time class="text-[10px]" datetime="2024-07-28T10:00">
                    Pukul 10:00 s/d 10:00
                  </time>
                </div>
              </div>
            </article>
            <article class="flex space-x-3">
              <div
                class="text-red-800 font-semibold text-sm leading-none min-w-[30px]"
              >
                28
                <br />
                Jul
              </div>
              <div class="flex-grow">
                <h4 class="font-semibold leading-tight">
                  Desa Pacing Lurik Carnival
                </h4>
                <div class="flex items-center space-x-1 text-gray-600">
                  <i class="fas fa-calendar-alt text-[10px]"> </i>
                  <time class="text-[10px]" datetime="2024-07-28">
                    Tanggal 28 Jul, 2024
                  </time>
                </div>
                <div class="flex items-center space-x-1 text-gray-600">
                  <i class="fas fa-clock text-[10px]"> </i>
                  <time class="text-[10px]" datetime="2024-07-28T09:00">
                    Pukul 09:00 s/d 09:00
                  </time>
                </div>
              </div>
            </article>
          </div>
          <a
            class="text-red-800 text-xs sm:text-sm font-semibold hover:underline flex items-center justify-end space-x-1"
            href="agenda.php"
          >
            <span> Lihat Semua </span>
            <i class="fas fa-arrow-right text-[10px]"> </i>
          </a>
        </section>
        <!-- Polling -->
        <!-- <section
          aria-labelledby="polling-title"
          class="bg-white rounded-md shadow-md p-4 space-y-3"
        >
          <h3
            class="bg-red-800 text-white text-xs sm:text-sm font-semibold px-3 py-1 rounded-md"
            id="polling-title"
          >
            Polling
          </h3>
          <form aria-label="Polling tentang kemudahan konten atau isi website">
            <fieldset class="space-y-2 text-xs sm:text-sm">
              <legend class="font-semibold mb-2">
                Apakah konten atau isi website mudah dimengerti?
              </legend>
              <div class="flex items-center space-x-2">
                <input
                  class="focus:ring-red-700"
                  id="polling-sangat-mudah"
                  name="kemudahan"
                  type="radio"
                  value="Sangat Mudah"
                />
                <label for="polling-sangat-mudah"> Sangat Mudah </label>
              </div>
              <div class="flex items-center space-x-2">
                <input
                  class="focus:ring-red-700"
                  id="polling-mudah"
                  name="kemudahan"
                  type="radio"
                  value="Mudah"
                />
                <label for="polling-mudah"> Mudah </label>
              </div>
              <div class="flex items-center space-x-2">
                <input
                  class="focus:ring-red-700"
                  id="polling-kurang-mudah"
                  name="kemudahan"
                  type="radio"
                  value="Kurang Mudah"
                />
                <label for="polling-kurang-mudah"> Kurang Mudah </label>
              </div>
              <div class="flex items-center space-x-2">
                <input
                  class="focus:ring-red-700"
                  id="polling-tidak-mudah"
                  name="kemudahan"
                  type="radio"
                  value="Tidak Mudah"
                />
                <label for="polling-tidak-mudah"> Tidak Mudah </label>
              </div>
              <div class="flex items-center space-x-2">
                <input
                  class="focus:ring-red-700"
                  id="polling-sangat-tidak-mudah"
                  name="kemudahan"
                  type="radio"
                  value="Sangat Tidak Mudah"
                />
                <label for="polling-sangat-tidak-mudah">
                  Sangat Tidak Mudah
                </label>
              </div>
            </fieldset>
            <div class="flex justify-between mt-3">
              <button
                class="bg-red-800 hover:bg-red-900 text-white text-xs sm:text-sm font-semibold py-1.5 px-4 rounded-md"
                type="submit"
              >
                Vote
              </button>
              <button
                class="text-blue-600 text-xs sm:text-sm font-semibold hover:underline"
                type="button"
              >
                Hasil Polling
              </button>
            </div>
          </form>
        </section> -->
      </aside>
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
    <!-- Pop-up Modal -->
    <div
      id="popup-modal"
      class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden"
    >
      <div
        id="popup-content"
        class="bg-white rounded-lg p-5 max-w-md w-full shadow-xl mx-4 sm:mx-0"
      >
        <img
          id="popup-image"
          src=""
          alt="Gambar Galeri"
          class="w-full h-48 object-cover rounded mb-3"
        />
        <h3 id="popup-title" class="text-lg font-bold text-red-700 mb-2"></h3>
        <p id="popup-description" class="text-sm text-gray-700 mb-4"></p>
        <button
          onclick="closeModal()"
          class="px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800 w-full"
        >
          Tutup
        </button>
      </div>
    </div>
  </body>
  <script src="js/script.js"></script>
</html>
