<?php
include 'php/db.php';
$legenda = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM sejarah_desa WHERE bagian='legenda' LIMIT 1"));
$sejarah_umum = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM sejarah_desa WHERE bagian='sejarah_umum' LIMIT 1"));
$penutup = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM sejarah_desa WHERE bagian='penutup' LIMIT 1"));
$kepala = mysqli_query($konek, "SELECT * FROM tokoh_sejarah ORDER BY id ASC");
?>
<html class="scroll-smooth" lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Sejarah Desa Pacing - Pemerintah Desa Pacing</title>
    <link rel="icon" href="assets/klaten-removebg.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet" />
    <style>
      body { font-family: "Inter", sans-serif; }
      .scrollbar-hide::-webkit-scrollbar { display: none; }
      .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
      .timeline-item { position: relative; padding-left: 30px; margin-bottom: 30px; }
      .timeline-item::before { content: ""; position: absolute; left: 8px; top: 8px; width: 12px; height: 12px; background-color: #991b1b; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #991b1b; }
      .timeline-item::after { content: ""; position: absolute; left: 13px; top: 25px; width: 2px; height: calc(100% + 5px); background-color: #e5e7eb; }
      .timeline-item:last-child::after { display: none; }
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
              height="28"
              src="assets/klaten-removebg.png"
              width="28"
            />
            <span class="text-red-800 text-base">Desa Pacing, Klaten</span>
          </div>

          <!-- Tombol Hamburger (Mobile) -->
          <button
            id="menu-toggle"
            class="md:hidden text-red-800 focus:outline-none"
          >
            <svg
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
          </button>

          <ul
            class="hidden md:flex items-center space-x-6 text-xs sm:text-sm font-semibold"
          >
            <li>
              <a class="hover:text-gray-700" href="index.php">Beranda</a>
            </li>

            <!-- Dropdown Menu Template -->
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
        <!-- Menu Mobile -->
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
              <a href="data_penduduk.php" class="block px-2 py-1 rounded hover:bg-gray-100"
                >Data Penduduk</a
              >
              <a href="data_keuangan.php" class="block px-2 py-1 rounded hover:bg-gray-100"
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
            aria-label="Pilih kategori berita"
            class="w-full border border-gray-300 rounded-md text-xs sm:text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-700"
            name="kategori"
            id="kategori-pencarian"
          >
            <option value="berita">Berita</option>
            <option value="pengumuman">Pengumuman</option>
            <option value="agenda">Agenda</option>
          </select>
        </div>
        <form
          aria-label="Cari berita"
          class="flex flex-grow sm:flex-row w-full"
          role="search"
          method="GET"
          id="form-pencarian"
          action="berita.php"
        >
          <input
            aria-label="Cari berita"
            class="flex-grow border border-gray-300 rounded-l-md text-xs sm:text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-700"
            placeholder="Cari berita yang Anda butuhkan . . ."
            type="search"
            name="search"
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
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
              <span class="text-gray-700 font-semibold">Sejarah</span>
            </div>
          </li>
        </ol>
      </nav>
    </section>

    <!-- Main content -->
    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-6">
      <div
        class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sm:p-8"
      >
        <!-- Header -->
        <div class="text-center mb-8">
          <h1
            class="text-center text-2xl sm:text-3xl font-bold text-red-800 border-b-2 border-red-800 pb-2 mb-6"
          >
            Sejarah Desa Pacing
          </h1>
        </div>
        <!-- Legenda/Asal Usul Desa -->
        <div class="mb-8">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-landmark text-red-700 mr-2"></i>
            Asal Usul Desa Pacing
          </h2>
          <div class="bg-gray-50 rounded-lg p-6 mb-6 text-justify">
            <div class="flex flex-col md:flex-row items-start gap-6">
              <?php if ($legenda && $legenda['gambar']) { ?>
                <div class="md:w-1/3 w-full mb-4 md:mb-0 flex-shrink-0">
                  <img src="assets/<?= $legenda['gambar'] ?>" alt="Legenda Desa" class="rounded shadow max-h-64 w-full object-cover" />
                </div>
                <div class="md:w-2/3 w-full">
                  <p class="text-gray-700 leading-relaxed">
                    <?= nl2br($legenda['konten'] ?? '-') ?>
                  </p>
                </div>
              <?php } else { ?>
                <div class="w-full">
                  <p class="text-gray-700 leading-relaxed">
                    <?= nl2br($legenda['konten'] ?? '-') ?>
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- Sejarah Umum -->
        <div class="mb-8">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-landmark text-red-700 mr-2"></i>
            Sejarah Umum Desa Pacing
          </h2>
          <div class="bg-gray-50 rounded-lg p-6 mb-6 text-justify">
            <p class="text-gray-700 leading-relaxed">
              <?= nl2br($sejarah_umum['konten'] ?? '-') ?>
            </p>
          </div>
        </div>
        <!-- Daftar Kepala Desa -->
        <div class="mb-8">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-users text-red-700 mr-2"></i>
            Daftar Kepala Desa
          </h2>
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 text-sm rounded-lg overflow-hidden">
              <thead class="bg-red-100 text-red-800">
                <tr>
                  <th class="px-4 py-2 border-b text-left">Nama</th>
                  <th class="px-4 py-2 border-b text-left">Alamat</th>
                  <th class="px-4 py-2 border-b text-left">Periode</th>
                  <th class="px-4 py-2 border-b text-left">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($d = mysqli_fetch_assoc($kepala)) { ?>
                <tr class="hover:bg-red-50">
                  <td class="px-4 py-2 border-b font-semibold"><?= htmlspecialchars($d['nama']) ?></td>
                  <td class="px-4 py-2 border-b"><?= htmlspecialchars($d['alamat']) ?></td>
                  <td class="px-4 py-2 border-b"><?= htmlspecialchars($d['periode']) ?></td>
                  <td class="px-4 py-2 border-b"><?= htmlspecialchars($d['keterangan']) ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Penutup -->
        <div class="mb-8">
          <h2 class="text-xl font-semibold text-red-800 mb-4 flex items-center">
            <i class="fas fa-heart text-red-700 mr-2"></i>
            Penutup
          </h2>
        </div>
        <div class="bg-red-50 rounded-lg p-6 border border-red-200">
          <p class="text-gray-700 leading-relaxed">
            <?= nl2br($penutup['konten'] ?? '-') ?>
          </p>
        </div>
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
  </body>
  <script src="js/script.js"></script>
  <script>
    // Ubah action form sesuai kategori
    const kategoriSelect = document.getElementById('kategori-pencarian');
    const formPencarian = document.getElementById('form-pencarian');
    kategoriSelect.addEventListener('change', function() {
      if (this.value === 'berita') formPencarian.action = 'berita.php';
      else if (this.value === 'pengumuman') formPencarian.action = 'pengumuman.php';
      else if (this.value === 'agenda') formPencarian.action = 'agenda.php';
    });
  </script>
</html>
