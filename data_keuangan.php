<?php
session_start();
require_once 'php/db.php';

// Fungsi untuk format rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Ambil tahun anggaran yang tersedia
$tahun_anggaran = [];
$query_tahun = $konek->query("SELECT DISTINCT tahun FROM tahun_anggaran ORDER BY tahun DESC");
while ($row = $query_tahun->fetch_assoc()) {
    $tahun_anggaran[] = $row['tahun'];
}

// Default tahun yang ditampilkan (tahun terbaru)
$tahun_selected = $_GET['tahun'] ?? ($tahun_anggaran[0] ?? date('Y'));

// Fungsi untuk mengambil data dari database
function getData($konek, $tahun, $table) {
    $data = [];
    $total = 0;
    
    $stmt = $konek->prepare("SELECT * FROM $table 
                            JOIN tahun_anggaran t ON {$table}.tahun_anggaran_id = t.id 
                            WHERE t.tahun = ?");
    $stmt->bind_param("s", $tahun);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $total += $row['jumlah'];
    }
    
    $stmt->close();
    return ['data' => $data, 'total' => $total];
}

// Ambil data pendapatan, belanja, dan pembiayaan
$pendapatan_data = getData($konek, $tahun_selected, 'pendapatan_desa');
$pendapatan = $pendapatan_data['data'];
$total_pendapatan = $pendapatan_data['total'];

$belanja_data = getData($konek, $tahun_selected, 'belanja_desa');
$belanja = $belanja_data['data'];
$total_belanja = $belanja_data['total'];

$pembiayaan_data = getData($konek, $tahun_selected, 'pembiayaan_desa');
$pembiayaan = $pembiayaan_data['data'];
$total_pembiayaan = $pembiayaan_data['total'];

// Hitung surplus/defisit
$surplus_defisit = $total_pendapatan - $total_belanja;

// Kelompokkan data belanja berdasarkan bidang
$grouped_belanja = [];
foreach ($belanja as $item) {
    $bidang = $item['bidang'];
    if (!isset($grouped_belanja[$bidang])) {
        $grouped_belanja[$bidang] = [
            'total' => 0,
            'items' => []
        ];
    }
    $grouped_belanja[$bidang]['total'] += $item['jumlah'];
    $grouped_belanja[$bidang]['items'][] = $item;
}
?>

<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Data Keuangan Desa - Pemerintah Desa Pacing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
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
      .progress-bar {
        height: 20px;
        border-radius: 4px;
        overflow: hidden;
      }
      .progress-fill {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 5px;
        font-size: 12px;
        color: white;
      }
    </style>
</head>
<body class="bg-white text-black">
    <!-- Header -->
    <header class="border-b border-gray-200">
      <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <nav aria-label="Primary Navigation" class="flex items-center justify-between h-16 text-xs sm:text-sm font-semibold">
          <div class="flex items-center space-x-2">
            <img alt="Logo Pemerintah Desa Pacing" class="block" height="32" src="assets/klaten.jpg" width="32" />
            <span class="text-red-800">Desa Pacing, Klaten</span>
          </div>

          <!-- Tombol Hamburger (Mobile) -->
          <button id="menu-toggle" class="md:hidden text-red-800 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>

          <ul class="hidden md:flex items-center space-x-6 text-xs sm:text-sm font-semibold">
            <li><a class="hover:text-gray-700" href="index.php">Beranda</a></li>
            <li class="relative group">
              <button class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none">
                <span>Profil</span>
                <i class="fas fa-chevron-down text-[8px] mt-[2px]"></i>
              </button>
              <div class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 shadow-lg opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100 transition-all duration-300 origin-top z-50">
                <a href="profil.php" class="block px-4 py-2 hover:bg-gray-100">Profil Pejabat</a>
                <a href="visimisi.php" class="block px-4 py-2 hover:bg-gray-100">Visi dan Misi</a>
                <a href="sejarah.php" class="block px-4 py-2 hover:bg-gray-100">Sejarah</a>
                <a href="struktur.php" class="block px-4 py-2 hover:bg-gray-100">Struktur</a>
                <a href="geografi.php" class="block px-4 py-2 hover:bg-gray-100">Geografi</a>
              </div>
            </li>

            <li class="relative group active">
              <button class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none">
                <span>Data Desa</span>
                <i class="fas fa-chevron-down text-[8px] mt-[2px]"></i>
              </button>
              <div class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 shadow-lg opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100 transition-all duration-300 origin-top z-50">
                <a href="data_penduduk.php" class="block px-4 py-2 hover:bg-gray-100">Data Penduduk</a>
                <a href="data_keuangan.php" class="block px-4 py-2 hover:bg-gray-100">Data Keuangan</a>
              </div>
            </li>

            <li class="relative group">
              <button class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none">
                <span>Informasi</span>
                <i class="fas fa-chevron-down text-[8px] mt-[2px]"></i>
              </button>
              <div class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 shadow-lg opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100 transition-all duration-300 origin-top z-50">
                <a href="berita.php" class="block px-4 py-2 hover:bg-gray-100">Berita</a>
                <a href="galeri.php" class="block px-4 py-2 hover:bg-gray-100">Galeri</a>
                <a href="potensi.php" class="block px-4 py-2 hover:bg-gray-100">Potensi</a>
              </div>
            </li>

            <li>
              <a href="admin/login.php" class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-900 transition duration-300">
                Login Admin
              </a>
            </li>
          </ul>
        </nav>
        
        <!-- Menu Mobile -->
        <div id="mobile-menu" class="md:hidden hidden px-4 pt-4 pb-6 bg-white border-t border-gray-200 shadow-sm space-y-4 text-sm font-semibold text-gray-700 animate-fade-in">
          <a href="index.php" class="block px-2 py-2 rounded hover:bg-red-50 hover:text-red-700 transition">Beranda</a>

          <!-- Profil -->
          <details class="group">
            <summary class="cursor-pointer px-2 py-2 rounded hover:bg-red-50 hover:text-red-700 transition">
              Profil
            </summary>
            <div class="pl-4 mt-1 space-y-1 text-sm text-gray-600">
              <a href="profil.php" class="block px-2 py-1 rounded hover:bg-gray-100">Profil Pejabat</a>
              <a href="visimisi.php" class="block px-2 py-1 rounded hover:bg-gray-100">Visi dan Misi</a>
              <a href="sejarah.php" class="block px-2 py-1 rounded hover:bg-gray-100">Sejarah</a>
              <a href="struktur.php" class="block px-2 py-1 rounded hover:bg-gray-100">Struktur</a>
              <a href="geografi.php" class="block px-2 py-1 rounded hover:bg-gray-100">Geografi</a>
            </div>
          </details>

          <!-- PPID -->
          <details class="group">
            <summary class="cursor-pointer px-2 py-2 rounded hover:bg-red-50 hover:text-red-700 transition">
              Data Desa
            </summary>
            <div class="pl-4 mt-1 space-y-1 text-sm text-gray-600">
              <a href="data_penduduk.php" class="block px-2 py-1 rounded hover:bg-gray-100">Data Penduduk</a>
              <a href="data_keuangan.php" class="block px-2 py-1 rounded hover:bg-gray-100">Data Keuangan</a>
            </div>
          </details>

          <!-- Informasi -->
          <details class="group">
            <summary class="cursor-pointer px-2 py-2 rounded hover:bg-red-50 hover:text-red-700 transition">
              Informasi
            </summary>
            <div class="pl-4 mt-1 space-y-1 text-sm text-gray-600">
              <a href="berita.php" class="block px-2 py-1 rounded hover:bg-gray-100">Berita</a>
              <a href="galeri.php" class="block px-2 py-1 rounded hover:bg-gray-100">Galeri</a>
              <a href="potensi.php" class="block px-2 py-1 rounded hover:bg-gray-100">Potensi</a>
            </div>
          </details>

          <a href="admin/login.php" class="block mt-2 px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 transition">
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
      <nav class="flex text-xs sm:text-sm text-gray-600" aria-label="Breadcrumb">
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
              <span class="text-gray-700 font-semibold">Data Keuangan</span>
            </div>
          </li>
        </ol>
      </nav>
    </section>

    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-6 text-sm text-gray-800">
      <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6 space-y-10">
        <h1 class="text-center text-2xl sm:text-3xl font-bold text-red-800 border-b-2 border-red-800 pb-2 mb-6">
          APBDes DESA PACING TAHUN <?= htmlspecialchars($tahun_selected) ?>
        </h1>

        <!-- Tahun Anggaran -->
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-semibold">Tahun Anggaran:</h2>
          <select id="selectTahun" class="border border-gray-300 rounded-md text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-700">
            <?php foreach ($tahun_anggaran as $tahun): ?>
            <option value="<?= htmlspecialchars($tahun) ?>" <?= $tahun == $tahun_selected ? 'selected' : '' ?>>
              <?= htmlspecialchars($tahun) ?>
            </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Ringkasan -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
          <!-- Total Pendapatan -->
          <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-lg shadow-sm">
            <div class="flex items-center">
              <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                <i class="fas fa-wallet"></i>
              </div>
              <div>
                <h3 class="text-sm font-medium text-gray-600">Total Pendapatan</h3>
                <p class="text-xl font-bold"><?= formatRupiah($total_pendapatan) ?></p>
              </div>
            </div>
          </div>

          <!-- Total Belanja -->
          <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-lg shadow-sm">
            <div class="flex items-center">
              <div class="p-2 rounded-full bg-red-100 text-red-600 mr-3">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <div>
                <h3 class="text-sm font-medium text-gray-600">Total Belanja</h3>
                <p class="text-xl font-bold"><?= formatRupiah($total_belanja) ?></p>
              </div>
            </div>
          </div>

          <!-- Surplus/Defisit -->
          <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded-lg shadow-sm">
            <div class="flex items-center">
              <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                <i class="fas fa-balance-scale"></i>
              </div>
              <div>
                <h3 class="text-sm font-medium text-gray-600">Surplus/Defisit</h3>
                <p class="text-xl font-bold <?= $surplus_defisit < 0 ? 'text-red-600' : 'text-green-600' ?>">
                  <?= formatRupiah($surplus_defisit) ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Pembiayaan -->
          <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4 rounded-lg shadow-sm">
            <div class="flex items-center">
              <div class="p-2 rounded-full bg-yellow-100 text-yellow-600 mr-3">
                <i class="fas fa-exchange-alt"></i>
              </div>
              <div>
                <h3 class="text-sm font-medium text-gray-600">Pembiayaan</h3>
                <p class="text-xl font-bold"><?= formatRupiah($total_pembiayaan) ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- P E N D A P A T A N -->
        <section>
          <h3 class="text-xl font-bold text-blue-600 mb-4">📊 PENDAPATAN</h3>

          <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
              <thead class="bg-blue-600 text-white">
                <tr>
                  <th class="py-3 px-4 text-left">No</th>
                  <th class="py-3 px-4 text-left">Jenis Pendapatan</th>
                  <th class="py-3 px-4 text-left">Jumlah</th>
                  <th class="py-3 px-4 text-left">Persentase</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <?php $no = 1; foreach ($pendapatan as $item): ?>
                <tr class="hover:bg-gray-50">
                  <td class="py-3 px-4"><?= $no++ ?></td>
                  <td class="py-3 px-4"><?= htmlspecialchars($item['kategori']) ?></td>
                  <td class="py-3 px-4"><?= formatRupiah($item['jumlah']) ?></td>
                  <td class="py-3 px-4">
                    <div class="flex items-center">
                      <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                        <div 
                          class="bg-blue-600 h-2.5 rounded-full" 
                          style="width: <?= $total_pendapatan > 0 ? ($item['jumlah'] / $total_pendapatan) * 100 : 0 ?>%">
                        </div>
                      </div>
                      <span class="text-sm text-gray-600">
                        <?= $total_pendapatan > 0 ? number_format(($item['jumlah'] / $total_pendapatan) * 100, 1) : 0 ?>%
                      </span>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
                <tr class="bg-blue-50 font-bold">
                  <td class="py-3 px-4" colspan="2">Total Pendapatan</td>
                  <td class="py-3 px-4"><?= formatRupiah($total_pendapatan) ?></td>
                  <td class="py-3 px-4">100%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        <!-- Belanja -->
        <section>
          <h3 class="text-xl font-bold text-red-600 mb-4">💸 BELANJA</h3>
          
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
              <thead class="bg-red-600 text-white">
                <tr>
                  <th class="py-3 px-4 text-left">No</th>
                  <th class="py-3 px-4 text-left">Bidang/Belanja</th>
                  <th class="py-3 px-4 text-left">Sub Bidang</th>
                  <th class="py-3 px-4 text-left">Jumlah</th>
                  <th class="py-3 px-4 text-left">Persentase</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <?php $no = 1; foreach ($grouped_belanja as $bidang => $group): 
                    $bidang_total = $group['total'];
                    $items = $group['items'];
                    $rowspan = count($items);
                ?>
                  <?php foreach ($items as $index => $item): ?>
                  <tr class="hover:bg-gray-50">
                    <?php if ($index === 0): ?>
                      <td class="py-3 px-4" rowspan="<?= $rowspan ?>"><?= $no++ ?></td>
                      <td class="py-3 px-4" rowspan="<?= $rowspan ?>"><?= htmlspecialchars($bidang) ?></td>
                    <?php endif; ?>
                    
                    <td class="py-3 px-4"><?= htmlspecialchars($item['sub_bidang']) ?></td>
                    <td class="py-3 px-4"><?= formatRupiah($item['jumlah']) ?></td>
                    
                    <?php if ($index === 0): ?>
                      <td class="py-3 px-4" rowspan="<?= $rowspan ?>">
                        <div class="flex items-center">
                          <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                            <div 
                              class="bg-red-600 h-2.5 rounded-full" 
                              style="width: <?= $total_belanja > 0 ? ($bidang_total / $total_belanja) * 100 : 0 ?>%">
                            </div>
                          </div>
                          <span class="text-sm text-gray-600">
                            <?= $total_belanja > 0 ? number_format(($bidang_total / $total_belanja) * 100, 1) : 0 ?>%
                          </span>
                        </div>
                      </td>
                    <?php endif; ?>
                  </tr>
                  <?php endforeach; ?>
                <?php endforeach; ?>
                <tr class="bg-red-50 font-bold">
                  <td class="py-3 px-4" colspan="2">Total Belanja</td>
                  <td class="py-3 px-4"></td>
                  <td class="py-3 px-4"><?= formatRupiah($total_belanja) ?></td>
                  <td class="py-3 px-4">100%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        <!-- Surplus / Defisit -->
        <section>
          <h3 class="text-xl font-bold text-green-600 mb-4">
            📈 SURPLUS / (DEFISIT)
          </h3>
          
          <div class="bg-green-50 border-l-4 border-green-600 p-6 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
              <div>
                <h3 class="text-lg font-semibold text-gray-700">Saldo APBDes</h3>
                <p class="text-sm text-gray-600">Pendapatan - Belanja</p>
              </div>
              <div class="text-2xl font-bold <?= $surplus_defisit < 0 ? 'text-red-600' : 'text-green-700' ?>">
                <?= formatRupiah($surplus_defisit) ?>
              </div>
            </div>
          </div>
        </section>

        <!-- Pembiayaan -->
        <section>
          <h3 class="text-xl font-bold text-purple-600 mb-4">💼 PEMBIAYAAN</h3>
          
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
              <thead class="bg-purple-600 text-white">
                <tr>
                  <th class="py-3 px-4 text-left">No</th>
                  <th class="py-3 px-4 text-left">Jenis Pembiayaan</th>
                  <th class="py-3 px-4 text-left">Jumlah</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <?php $no = 1; foreach ($pembiayaan as $item): ?>
                <tr class="hover:bg-gray-50">
                  <td class="py-3 px-4"><?= $no++ ?></td>
                  <td class="py-3 px-4"><?= htmlspecialchars($item['jenis']) ?></td>
                  <td class="py-3 px-4"><?= formatRupiah($item['jumlah']) ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="bg-purple-50 font-bold">
                  <td class="py-3 px-4" colspan="2">Total Pembiayaan</td>
                  <td class="py-3 px-4"><?= formatRupiah($total_pembiayaan) ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        <!-- Grafik Belanja -->
        <section>
          <h3 class="text-xl font-bold text-gray-700 mb-4">📊 GRAFIK ALOKASI BELANJA</h3>
          <div class="flex justify-center">
            <div class="w-full md:w-1/2">
              <canvas id="belanjaChart"></canvas>
            </div>
          </div>
        </section>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white text-xs sm:text-sm mt-10">
      <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <h4 class="font-semibold mb-2">Desa Pacing</h4>
          <h5 class="font-semibold mb-1">Kebijakan Privasi</h5>
          <address class="not-italic mb-1">
            Alamat<br />
            Dusun I, Pacing, Kec. Wedi, Kabupaten Klaten, Jawa Tengah 57461
          </address>
          <p class="mb-1">
            Telepon<br />
            <a class="hover:underline" href="tel:0272321046">0272-321046</a>
          </p>
          <p>
            Email<br />
            <a class="hover:underline" href="mailto:pemkab@pacing.go.id">
              pemkab@pacing.go.id
            </a>
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
      <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-2 border-t border-gray-700 flex justify-between text-[10px] sm:text-xs">
        <p>©Copyright Desa Pacing</p>
        <p>Dibuat Oleh Desa Pacing</p>
      </div>
    </footer>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      // Handler untuk select tahun
      document.getElementById('selectTahun').addEventListener('change', function() {
        var tahun = this.value;
        window.location.href = 'data_keuangan.php?tahun=' + tahun;
      });

      // Grafik Belanja
      const ctx = document.getElementById('belanjaChart');
      
      // Ambil data dari PHP untuk chart
      const bidangLabels = [];
      const bidangData = [];
      const bidangColors = [
        '#3b82f6', // blue
        '#ef4444', // red
        '#10b981', // green
        '#f59e0b', // yellow
        '#8b5cf6', // purple
        '#ec4899', // pink
        '#14b8a6', // teal
      ];
      
      <?php
      $no_color = 0;
      foreach ($grouped_belanja as $bidang => $group): 
          $persentase = $total_belanja > 0 ? ($group['total'] / $total_belanja) * 100 : 0;
      ?>
          bidangLabels.push("<?= addslashes($bidang) ?> (<?= number_format($persentase, 1) ?>%)");
          bidangData.push(<?= $group['total'] ?>);
      <?php 
          $no_color++;
      endforeach; 
      ?>
      
      new Chart(ctx, {
        type: 'pie',
        data: {
          labels: bidangLabels,
          datasets: [{
            data: bidangData,
            backgroundColor: bidangColors,
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'right',
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  let label = context.label || '';
                  let value = context.raw || 0;
                  let total = context.dataset.data.reduce((a, b) => a + b, 0);
                  let percentage = Math.round((value / total) * 100);
                  return `${label}: Rp ${value.toLocaleString('id-ID')} (${percentage}%)`;
                }
              }
            }
          }
        }
      });
    </script>
    
    <script src="js/script.js"></script>
  </body>
</html>