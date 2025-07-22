<?php
include 'php/db.php';

// Gender
$gender = $konek->query("SELECT * FROM penduduk_kelamin")->fetch_assoc();
$dataGender = [$gender['laki_laki'], $gender['perempuan']];
$totalPenduduk = $gender['laki_laki'] + $gender['perempuan'];

// Usia
$usia = $konek->query("SELECT * FROM penduduk_usia ORDER BY id ASC");
$dataUsia = [];
$labelUsia = [];
$dewasa19Plus = 0;

while ($row = $usia->fetch_assoc()) {
  $labelUsia[] = $row['kategori'];
  $dataUsia[] = $row['total'];

  // Cek jika kategori adalah 19+
  if ($row['kategori'] == '19+') {
    $dewasa19Plus = $row['total'];
  }
}

// Pekerjaan
$pekerjaan = $konek->query("SELECT * FROM penduduk_pekerjaan ORDER BY id ASC");
$dataPekerjaan = [];
$labelPekerjaan = [];
while ($row = $pekerjaan->fetch_assoc()) {
  $labelPekerjaan[] = $row['kategori'];
  $dataPekerjaan[] = $row['total'];
}

// Pendidikan
$pendidikan = $konek->query("SELECT * FROM penduduk_pendidikan ORDER BY id ASC");
$dataPendidikan = [];
$labelPendidikan = [];
while ($row = $pendidikan->fetch_assoc()) {
  $labelPendidikan[] = $row['kategori'];
  $dataPendidikan[] = $row['total'];
}

// Hitung anak-anak (0-18)
$anakAnak = 0;
foreach ($labelUsia as $index => $kategori) {
  // Pisahkan batas usia (misal: "4-6")
  if ($kategori !== '19+') {
    $anakAnak += $dataUsia[$index];
  }
}

// Hitung persentase
$persenLaki = round($gender['laki_laki'] / $totalPenduduk * 100, 1);
$persenPerempuan = round($gender['perempuan'] / $totalPenduduk * 100, 1);
$persenAnak = round($anakAnak / $totalPenduduk * 100, 1);
$persenDewasa = round($dewasa19Plus / $totalPenduduk * 100, 1);

// Pekerjaan terbanyak
$maxPekerjaan = max($dataPekerjaan);
$indexPekerjaan = array_search($maxPekerjaan, $dataPekerjaan);
$pekerjaanTerbanyak = $labelPekerjaan[$indexPekerjaan];

// Pendidikan terbanyak
$maxPendidikan = max($dataPendidikan);
$indexPendidikan = array_search($maxPendidikan, $dataPendidikan);
$pendidikanTerbanyak = $labelPendidikan[$indexPendidikan];

// Rasio gender
$rasioGender = round($gender['laki_laki'] / $gender['perempuan'] * 100);
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
      .scrollbar-hide::-webkit-scrollbar {
        display: none;
      }
      .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
      .chart-container {
        position: relative;
        height: 400px;
        margin-bottom: 2rem;
      }
      @media (max-width: 640px) {
        .chart-container {
          height: 300px;
        }
      }
    </style>
  </head>
  <body class="bg-white text-black">
    <!-- Header -->
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
            <span class="text-red-800">Desa Pacing, Klaten</span>
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

            <li class="relative group active">
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

    <!-- Search and Filter Section -->
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
              <span class="text-gray-500">Data Desa</span>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
              <span class="text-gray-700 font-semibold">Data Penduduk</span>
            </div>
          </li>
        </ol>
      </nav>
    </section>

    <!-- Main Content -->
    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-6">
      <section class="bg-white rounded-lg shadow border border-gray-200 p-6">
        <h1
          class="text-center text-2xl sm:text-3xl font-bold text-red-800 border-b-2 border-red-800 pb-2 mb-8"
        >
          Data Penduduk Desa Pacing
        </h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
          <div
            class="bg-gradient-to-r from-red-500 to-red-600 text-white p-4 rounded-lg shadow"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm opacity-90">Total Penduduk</p>
                <p class="text-2xl font-bold" id="totalPenduduk"><?php echo number_format($totalPenduduk, 0, ',', '.'); ?></p>
              </div>
              <i class="fas fa-users text-2xl opacity-80"></i>
            </div>
          </div>
          <div
            class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-lg shadow"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm opacity-90">Laki-laki</p>
                <p class="text-2xl font-bold">
                  <?php echo number_format($gender['laki_laki'], 0, ',', '.'); ?>
                </p>
              </div>
              <i class="fas fa-male text-2xl opacity-80"></i>
            </div>
          </div>

          <div
            class="bg-gradient-to-r from-pink-500 to-pink-600 text-white p-4 rounded-lg shadow"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm opacity-90">Perempuan</p>
                <p class="text-2xl font-bold">
                  <?php echo number_format($gender['perempuan'], 0, ',', '.'); ?>
                </p>
              </div>
              <i class="fas fa-female text-2xl opacity-80"></i>
            </div>
          </div>

          <div
            class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-lg shadow"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm opacity-90">Dewasa (19+)</p>
                <p class="text-2xl font-bold"><?= $dewasa19Plus ?></p>
              </div>
              <i class="fas fa-user-check text-2xl opacity-80"></i>
            </div>
          </div>
        </div>

        <!-- Charts Section -->
        <div class="space-y-8">
          <!-- Gender Chart -->
          <div class="bg-gray-50 p-6 rounded-lg">
            <h2
              class="text-xl font-semibold text-gray-800 mb-4 flex items-center"
            >
              <i class="fas fa-chart-bar mr-2 text-red-700"></i>
              Distribusi Penduduk Berdasarkan Jenis Kelamin
            </h2>
            <div class="chart-container">
              <canvas id="barChartPenduduk"></canvas>
            </div>
          </div>

          <!-- Age Chart -->
          <div class="bg-gray-50 p-6 rounded-lg">
            <h2
              class="text-xl font-semibold text-gray-800 mb-4 flex items-center"
            >
              <i class="fas fa-chart-bar mr-2 text-red-700"></i>
              Distribusi Penduduk Berdasarkan Usia
            </h2>
            <div class="chart-container">
              <canvas id="barChartUsia"></canvas>
            </div>
          </div>

          <!-- Education Chart -->
          <div class="bg-gray-50 p-6 rounded-lg">
            <h2
              class="text-xl font-semibold text-gray-800 mb-4 flex items-center"
            >
              <i class="fas fa-chart-pie mr-2 text-red-700"></i>
              Distribusi Penduduk Berdasarkan Pendidikan
            </h2>
            <div class="chart-container">
              <canvas id="pieChartPendidikan"></canvas>
            </div>
          </div>

          <!-- Occupation Chart -->
          <div class="bg-gray-50 p-6 rounded-lg">
            <h2
              class="text-xl font-semibold text-gray-800 mb-4 flex items-center"
            >
              <i class="fas fa-chart-pie mr-2 text-red-700"></i>
              Distribusi Penduduk Berdasarkan Pekerjaan
            </h2>
            <div class="chart-container">
              <canvas id="pieChartPekerjaan"></canvas>
            </div>
          </div>
        </div>

        <!-- Data Tables -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Summary Table -->
          <div class="bg-white border rounded-lg overflow-hidden">
            <div class="bg-red-700 text-white p-4">
              <h3 class="font-semibold">Ringkasan Data</h3>
            </div>
          <div class="p-4">
            <table class="w-full text-sm">
              <tbody class="divide-y divide-gray-200">
                <tr>
                  <td class="py-2 font-medium">Total Penduduk</td>
                  <td class="py-2 text-right"><?= number_format($totalPenduduk, 0, ',', '.') ?> orang</td>
                </tr>
                <tr>
                  <td class="py-2 font-medium">Laki-laki</td>
                  <td class="py-2 text-right"><?= number_format($gender['laki_laki'], 0, ',', '.') ?> orang (<?= $persenLaki ?>%)</td>
                </tr>
                <tr>
                  <td class="py-2 font-medium">Perempuan</td>
                  <td class="py-2 text-right"><?= number_format($gender['perempuan'], 0, ',', '.') ?> orang (<?= $persenPerempuan ?>%)</td>
                </tr>
                <tr>
                  <td class="py-2 font-medium">Anak-anak (0-18)</td>
                  <td class="py-2 text-right"><?= number_format($anakAnak, 0, ',', '.') ?> orang (<?= $persenAnak ?>%)</td>
                </tr>
                <tr>
                  <td class="py-2 font-medium">Dewasa (19+)</td>
                  <td class="py-2 text-right"><?= number_format($dewasa19Plus, 0, ',', '.') ?> orang (<?= $persenDewasa ?>%)</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>


          <!-- Key Statistics -->
          <!-- Key Statistics -->
          <div class="bg-white border rounded-lg overflow-hidden">
            <div class="bg-red-700 text-white p-4">
              <h3 class="font-semibold">Statistik Utama</h3>
            </div>
            <div class="p-4">
              <div class="space-y-3">
                <div class="flex justify-between items-center">
                  <span class="text-sm font-medium">Pendidikan Tertinggi</span>
                  <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded">
                    <?= $pendidikanTerbanyak ?> (<?= number_format($maxPendidikan, 0, ',', '.') ?> orang)
                  </span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-sm font-medium">Pekerjaan Utama</span>
                  <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">
                    <?= $pekerjaanTerbanyak ?> (<?= number_format($maxPekerjaan, 0, ',', '.') ?> orang)
                  </span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-sm font-medium">Kelompok Usia Terbanyak</span>
                  <span class="text-sm bg-purple-100 text-purple-800 px-2 py-1 rounded">
                    Dewasa 19+ (<?= number_format($dewasa19Plus, 0, ',', '.') ?> orang)
                  </span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-sm font-medium">Rasio Jenis Kelamin</span>
                  <span class="text-sm bg-gray-100 text-gray-800 px-2 py-1 rounded">
                    <?= $rasioGender ?>:100 (L:P)
                  </span>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
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

    <!-- Chart.js -->
    <script src="js/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
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
    <script>
      const toggleBtn = document.getElementById('menu-toggle');
      const mobileMenu = document.getElementById('mobile-menu');

      toggleBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    </script>

    <script>
      let chartGender, chartUsia, chartPendidikan, chartPekerjaan;

      // Global chart variables
      const dataGender = <?= json_encode($dataGender) ?>;
      const dataUsia = <?= json_encode($dataUsia) ?>;
      const labelUsia = <?= json_encode($labelUsia) ?>;
      const dataPekerjaan = <?= json_encode($dataPekerjaan) ?>;
      const labelPekerjaan = <?= json_encode($labelPekerjaan) ?>;
      const dataPendidikan = <?= json_encode($dataPendidikan) ?>;
      const labelPendidikan = <?= json_encode($labelPendidikan) ?>;
      // Wait for DOM to be fully loaded
      document.addEventListener("DOMContentLoaded", function () {
        // Initialize charts
        initializeCharts();

        // Add mobile menu functionality
        setupMobileMenu();

        // Add filter functionality
        setupFilters();
      });

      function initializeCharts() {
        // Destroy existing charts if they exist
        // Destroy existing charts if they exist
        if (chartGender) chartGender.destroy();
        if (chartUsia) chartUsia.destroy();
        if (chartPendidikan) chartPendidikan.destroy();
        if (chartPekerjaan) chartPekerjaan.destroy();


        // Gender Chart
        const ctxGender = document.getElementById("barChartPenduduk");
        if (ctxGender) {
          chartGender = new Chart(ctxGender, {
            type: "bar",
            data: {
              labels: ["Laki-laki", "Perempuan"],
              datasets: [
                {
                  label: "Jumlah Penduduk",
                  data: dataGender,
                  backgroundColor: ["#dc2626", "#f87171"],
                  borderColor: ["#b91c1c", "#ef4444"],
                  borderWidth: 1,
                  borderRadius: 8,
                  borderSkipped: false,
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                title: {
                  display: true,
                  text: "Distribusi Penduduk Berdasarkan Jenis Kelamin",
                  font: {
                    size: 16,
                    weight: "bold",
                  },
                },
                legend: {
                  display: false,
                },
              },
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    callback: function (value) {
                      return value.toLocaleString();
                    },
                  },
                },
              },
            },
          });
        }

        // Age Chart
        const ctxUsia = document.getElementById("barChartUsia");
        if (ctxUsia) {
          chartUsia = new Chart(ctxUsia, {
            type: "bar",
            data: {
              labels: labelUsia,
              datasets: [
                {
                  label: "Jumlah Penduduk",
                  data: dataUsia,
                  backgroundColor: [
                    "#fef3c7",
                    "#fde047",
                    "#facc15",
                    "#eab308",
                    "#ca8a04",
                    "#a16207",
                  ],
                  borderColor: [
                    "#f59e0b",
                    "#f59e0b",
                    "#f59e0b",
                    "#f59e0b",
                    "#f59e0b",
                    "#f59e0b",
                  ],
                  borderWidth: 1,
                  borderRadius: 8,
                  borderSkipped: false,
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                title: {
                  display: true,
                  text: "Distribusi Penduduk Berdasarkan Kelompok Usia",
                  font: {
                    size: 16,
                    weight: "bold",
                  },
                },
                legend: {
                  display: false,
                },
              },
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    callback: function (value) {
                      return value.toLocaleString();
                    },
                  },
                },
              },
            },
          });
        }

        // Education Chart
        const ctxPendidikan = document.getElementById("pieChartPendidikan");
        if (ctxPendidikan) {
          chartPendidikan = new Chart(ctxPendidikan, {
            type: "pie",
            data: {
              labels: labelPendidikan,
              datasets: [
                {
                  data: dataPendidikan,
                  backgroundColor: [
                    "#ef4444",
                    "#f97316",
                    "#facc15",
                    "#22c55e",
                    "#3b82f6",
                    "#8b5cf6",
                  ],
                  borderColor: "#ffffff",
                  borderWidth: 2,
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                title: {
                  display: true,
                  text: "Distribusi Penduduk Berdasarkan Tingkat Pendidikan",
                  font: {
                    size: 16,
                    weight: "bold",
                  },
                },
                legend: {
                  position: "bottom",
                  labels: {
                    padding: 20,
                    usePointStyle: true,
                  },
                },
              },
            },
          });
        }

        // Occupation Chart
        const ctxPekerjaan = document.getElementById("pieChartPekerjaan");
        if (ctxPekerjaan) {
          chartPekerjaan = new Chart(ctxPekerjaan, {
            type: "pie",
            data: {
              labels: labelPekerjaan,
              datasets: [
                {
                  data: dataPekerjaan,
                  backgroundColor: [
                    "#ef4444",
                    "#f97316",
                    "#facc15",
                    "#22c55e",
                    "#3b82f6",
                    "#8b5cf6",
                    "#ec4899",
                    "#14b8a6",
                    "#6366f1",
                    "#10b981", // Emerald — hijau kebiruan terang
                    "#0ea5e9", // Sky — biru muda cerah   
                  ],
                  borderColor: "#ffffff",
                  borderWidth: 2,
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                title: {
                  display: true,
                  text: "Distribusi Penduduk Berdasarkan Jenis Pekerjaan",
                  font: {
                    size: 16,
                    weight: "bold",
                  },
                },
                legend: {
                  position: "bottom",
                  labels: {
                    padding: 20,
                    usePointStyle: true,
                  },
                },
              },
            },
          });
        }
      }

      function setupMobileMenu() {
        const menuToggle = document.getElementById("menu-toggle");
        const mobileMenu = document.getElementById("mobile-menu");

        if (menuToggle && mobileMenu) {
          menuToggle.addEventListener("click", function () {
            mobileMenu.classList.toggle("hidden");
          });
        }
      }

      function setupFilters() {
        const filterSelect = document.getElementById("kategori-filter");

        if (filterSelect) {
          filterSelect.addEventListener("change", function () {
            const selectedValue = this.value;

            // Hide all charts
            document
              .querySelectorAll(".chart-container")
              .forEach((container) => {
                container.closest(".bg-gray-50").style.display = "none";
              });

            // Show selected chart or all charts
            if (selectedValue === "") {
              // Show all charts
              document
                .querySelectorAll(".chart-container")
                .forEach((container) => {
                  container.closest(".bg-gray-50").style.display = "block";
                });
            } else {
              // Show specific chart
              let targetChart = null;
              switch (selectedValue) {
                case "gender":
                  targetChart = document.getElementById("barChartPenduduk");
                  break;
                case "usia":
                  targetChart = document.getElementById("barChartUsia");
                  break;
                case "pendidikan":
                  targetChart = document.getElementById("pieChartPendidikan");
                  break;
                case "pekerjaan":
                  targetChart = document.getElementById("pieChartPekerjaan");
                  break;
              }

              if (targetChart) {
                targetChart.closest(".bg-gray-50").style.display = "block";
              }
            }
          });
        }
      }

      // Resize charts when window is resized
      window.addEventListener("resize", function () {
        if (chartGender) chartGender.resize();
        if (chartUsia) chartUsia.resize();
        if (chartPendidikan) chartPendidikan.resize();
        if (chartPekerjaan) chartPekerjaan.resize();
      });
    </script>
  </body>
</html>
