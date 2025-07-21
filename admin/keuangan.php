<?php
session_start();
require_once '../php/db.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}

// Fungsi untuk format rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Ambil tahun anggaran yang tersedia
$tahun_anggaran = [];
$query_tahun = $konek->query("SELECT DISTINCT tahun FROM tahun_anggaran ORDER BY tahun DESC");
while ($row = $query_tahun->fetch_assoc()) {
    $tahun_anggaran[] = $row;
}

// Default tahun yang ditampilkan (tahun terbaru)
$tahun_selected = isset($_GET['tahun']) ? $_GET['tahun'] : ($tahun_anggaran[0]['tahun'] ?? date('Y'));

// Ambil data pendapatan
$pendapatan = [];
$total_pendapatan = 0;
if (!empty($tahun_selected)) {
    $stmt = $konek->prepare("SELECT p.* FROM pendapatan_desa p 
                            JOIN tahun_anggaran t ON p.tahun_anggaran_id = t.id 
                            WHERE t.tahun = ?");
    $stmt->bind_param("s", $tahun_selected);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $pendapatan[] = $row;
        $total_pendapatan += $row['jumlah'];
    }
    $stmt->close();
}

// Ambil data belanja
$belanja = [];
$total_belanja = 0;
if (!empty($tahun_selected)) {
    $stmt = $konek->prepare("SELECT b.* FROM belanja_desa b 
                            JOIN tahun_anggaran t ON b.tahun_anggaran_id = t.id 
                            WHERE t.tahun = ?");
    $stmt->bind_param("s", $tahun_selected);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $belanja[] = $row;
        $total_belanja += $row['jumlah'];
    }
    $stmt->close();
}

// Ambil data pembiayaan
$pembiayaan = [];
$total_pembiayaan = 0;
if (!empty($tahun_selected)) {
    $stmt = $konek->prepare("SELECT p.* FROM pembiayaan_desa p 
                            JOIN tahun_anggaran t ON p.tahun_anggaran_id = t.id 
                            WHERE t.tahun = ?");
    $stmt->bind_param("s", $tahun_selected);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $pembiayaan[] = $row;
        $total_pembiayaan += $row['jumlah'];
    }
    $stmt->close();
}

// Hitung surplus/defisit
$surplus_defisit = $total_pendapatan - $total_belanja;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen Keuangan Desa - Desa Pacing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <style>
      .card-summary { border-left: 4px solid #007bff; }
      .card-pendapatan { border-left: 4px solid #28a745; }
      .card-belanja { border-left: 4px solid #dc3545; }
      .card-pembiayaan { border-left: 4px solid #ffc107; }
      .progress { height: 20px; }
      .progress-bar { font-size: 12px; line-height: 20px; }
      .table-detail td { padding: 0.5rem; }
      .badge-percent { font-size: 100%; padding: 5px 10px; }
      .sub-row { background-color: #f8f9fa; }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar dan Sidebar tetap sama seperti sebelumnya -->
        <!-- ... -->
                 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard.php" class="nav-link">Dashboard</a>
                </li>
            </ul>
        </nav>
        
        <aside class="main-sidebar sidebar-red elevation-4">
            <!-- Brand Logo -->
            <a href="../index.php" class="brand-link">
                <img src="../assets/klaten.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Desa Pacing</span>
            </a>

            <!-- Sidebar Menu -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Profil Dropdown -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>
                                    Profil
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pejabat.php" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>Manajemen Pejabat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="visimisi.php" class="nav-link">
                                        <i class="far fa-bullseye nav-icon"></i>
                                        <p>Manajemen Visi Misi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="sejarah.php" class="nav-link">
                                        <i class="fas fa-history nav-icon"></i>
                                        <p>Manajemen Sejarah</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Data Desa Dropdown -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Data Desa
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="penduduk.php" class="nav-link">
                                        <i class="far fa-users nav-icon"></i>
                                        <p>Manajemen Data Penduduk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="keuangan.php" class="nav-link">
                                        <i class="far fa-id-card nav-icon"></i>
                                        <p>Manajemen Keuangan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Informasi Desa Dropdown -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>
                                    Informasi Desa
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="berita.php" class="nav-link">
                                        <i class="far fa-newspaper nav-icon"></i>
                                        <p>Manajemen Berita</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="galeri.php" class="nav-link">
                                        <i class="far fa-image nav-icon"></i>
                                        <p>Manajemen Galeri</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="potensi.php" class="nav-link">
                                        <i class="fas fa-tree nav-icon"></i>
                                        <p>Manajemen Potensi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Manajemen APBDes Desa Pacing</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="btn-group">
                                <a href="tambahdata.php" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <section class="content">
                <div class="container-fluid">
                    <!-- Tahun Anggaran -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">APBDes Tahun Anggaran 
                                        <select id="selectTahun" class="form-control" style="width: auto; display: inline-block;">
                                            <?php foreach ($tahun_anggaran as $tahun): ?>
                                                <option value="<?= $tahun['tahun'] ?>" <?= $tahun['tahun'] == $tahun_selected ? 'selected' : '' ?>>
                                                    <?= $tahun['tahun'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-summary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-2"></i>Ringkasan APBDes
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="info-box bg-gradient-info">
                                                <span class="info-box-icon"><i class="fas fa-wallet"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Pendapatan</span>
                                                    <span class="info-box-number"><?= formatRupiah($total_pendapatan) ?></span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: 100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="info-box bg-gradient-danger">
                                                <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Belanja</span>
                                                    <span class="info-box-number"><?= formatRupiah($total_belanja) ?></span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: 100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="info-box bg-gradient-success">
                                                <span class="info-box-icon"><i class="fas fa-balance-scale"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Surplus/Defisit</span>
                                                    <span class="info-box-number"><?= formatRupiah($surplus_defisit) ?></span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: 100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="info-box bg-gradient-warning">
                                                <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Pembiayaan</span>
                                                    <span class="info-box-number"><?= formatRupiah($total_pembiayaan) ?></span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: 100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pendapatan -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-pendapatan">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-money-bill-wave mr-2"></i>Pendapatan Desa
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Pendapatan</th>
                                                <th>Jumlah</th>
                                                <th>Persentase</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($pendapatan as $item): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= htmlspecialchars($item['kategori']) ?></td>
                                                    <td><?= formatRupiah($item['jumlah']) ?></td>
                                                    <td>
                                                        <?php if ($total_pendapatan > 0): ?>
                                                            <?php $persentase = ($item['jumlah'] / $total_pendapatan) * 100; ?>
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar bg-success" style="width: <?= $persentase ?>%"></div>
                                                            </div>
                                                            <span class="badge bg-success"><?= number_format($persentase, 1) ?>%</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary">0%</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" 
                                                            data-id="<?= $item['id'] ?>" 
                                                            data-kategori="<?= htmlspecialchars($item['kategori']) ?>" 
                                                            data-jumlah="<?= $item['jumlah'] ?>" 
                                                            data-tipe="pendapatan">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete('pendapatan', <?= $item['id'] ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr class="bg-light">
                                                <td colspan="2"><strong>Total Pendapatan</strong></td>
                                                <td><strong><?= formatRupiah($total_pendapatan) ?></strong></td>
                                                <td><strong>100%</strong></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belanja -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-belanja">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-hand-holding-usd mr-2"></i>Belanja Desa
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Bidang/Belanja</th>
                                                <th>Sub Bidang</th>
                                                <th>Jumlah</th>
                                                <th>Persentase</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
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
                                            
                                            $no = 1; 
                                            foreach ($grouped_belanja as $bidang => $group): 
                                                $bidang_total = $group['total'];
                                                $items = $group['items'];
                                                $rowspan = count($items) > 1 ? 'rowspan="'.count($items).'"' : '';
                                            ?>
                                                <?php foreach ($items as $index => $item): ?>
                                                    <tr>
                                                        <?php if ($index === 0): ?>
                                                            <td <?= $rowspan ?>><?= $no++ ?></td>
                                                            <td <?= $rowspan ?>><?= htmlspecialchars($bidang) ?></td>
                                                        <?php endif; ?>
                                                        
                                                        <td><?= htmlspecialchars($item['sub_bidang']) ?></td>
                                                        <td><?= formatRupiah($item['jumlah']) ?></td>
                                                        
                                                        <?php if ($index === 0): ?>
                                                            <td <?= $rowspan ?>>
                                                                <?php if ($total_belanja > 0): ?>
                                                                    <?php $persentase = ($bidang_total / $total_belanja) * 100; ?>
                                                                    <div class="progress progress-xs">
                                                                        <div class="progress-bar bg-danger" style="width: <?= $persentase ?>%"></div>
                                                                    </div>
                                                                    <span class="badge bg-danger"><?= number_format($persentase, 1) ?>%</span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-secondary">0%</span>
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>
                                                        
                                                        <!-- Tombol aksi di setiap baris -->
                                                        <td>
                                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" 
                                                                data-id="<?= $item['id'] ?>" 
                                                                data-bidang="<?= htmlspecialchars($item['bidang']) ?>" 
                                                                data-sub_bidang="<?= html_entity_decode($item['sub_bidang']) ?>" 
                                                                data-jumlah="<?= $item['jumlah'] ?>" 
                                                                data-tipe="belanja">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('belanja', <?= $item['id'] ?>)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                            <tr class="bg-light">
                                                <td colspan="2"><strong>Total Belanja</strong></td>
                                                <td></td>
                                                <td><strong><?= formatRupiah($total_belanja) ?></strong></td>
                                                <td><strong>100%</strong></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pembiayaan -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-pembiayaan">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-exchange-alt mr-2"></i>Pembiayaan
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Pembiayaan</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($pembiayaan as $item): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= htmlspecialchars($item['jenis']) ?></td>
                                                    <td><?= formatRupiah($item['jumlah']) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" 
                                                            data-id="<?= $item['id'] ?>" 
                                                            data-jenis="<?= htmlspecialchars($item['jenis']) ?>" 
                                                            data-jumlah="<?= $item['jumlah'] ?>" 
                                                            data-tipe="pembiayaan">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete('pembiayaan', <?= $item['id'] ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr class="bg-light">
                                                <td colspan="2"><strong>Total Pembiayaan</strong></td>
                                                <td><strong><?= formatRupiah($total_pembiayaan) ?></strong></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <!-- Footer tetap sama seperti sebelumnya -->
        <!-- ... -->
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="post" action="../php/proses_keuangan.php?action=update">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <input type="hidden" name="tipe" id="editTipe">
                        
                        <div class="form-group" id="kategoriGroup">
                            <label for="editKategori">Kategori</label>
                            <input type="text" class="form-control" id="editKategori" name="kategori">
                        </div>
                        
                        <div class="form-group" id="bidangGroup" style="display: none;">
                            <label for="editBidang">Bidang</label>
                            <input type="text" class="form-control" id="editBidang" name="bidang">
                        </div>
                        
                        <div class="form-group" id="subBidangGroup" style="display: none;">
                            <label for="editSubBidang">Sub Bidang</label>
                            <input type="text" class="form-control" id="editSubBidang" name="sub_bidang">
                        </div>
                        
                        <div class="form-group" id="jenisGroup" style="display: none;">
                            <label for="editJenis">Jenis</label>
                            <input type="text" class="form-control" id="editJenis" name="jenis">
                        </div>
                        
                        <div class="form-group">
                            <label for="editJumlah">Jumlah (Rp)</label>
                            <input type="text" class="form-control" id="editJumlah" name="jumlah">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Load jQuery pertama -->
<!-- jQuery (pastikan ini duluan) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap Bundle (termasuk Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Terakhir AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script>
    $(document).ready(function () {

    // Format angka sebagai mata uang
    function formatRupiah(angka) {
        if (!angka) return '';
        var number_string = angka.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        return rupiah;
    }

    // Fungsi untuk mengubah format Rupiah ke angka
    function parseRupiah(rupiah) {
        if (!rupiah) return 0;
        return parseInt(rupiah.replace(/[^\d]/g, ""));
    }

    // Format input jumlah saat edit
    $(document).on('keyup', '#editJumlah', function() {
        var value = $(this).val().replace(/[^\d]/g, "");
        $(this).val(formatRupiah(value));
    });

    // Handler untuk tombol edit - gunakan event delegation
    $(document).on('click', '[data-toggle="modal"][data-target="#editModal"]', function (event) {
        var button = $(this);
        var id = button.data('id');
        var tipe = button.data('tipe');
        
        $('#editId').val(id);
        $('#editTipe').val(tipe);
        
        // Sembunyikan semua group terlebih dahulu
        $('#kategoriGroup').hide();
        $('#bidangGroup').hide();
        $('#subBidangGroup').hide();
        $('#jenisGroup').hide();
        
        if (tipe === 'pendapatan') {
            var kategori = button.data('kategori');
            var jumlah = button.data('jumlah');
            
            $('#kategoriGroup').show();
            $('#editKategori').val(kategori);
            $('#editJumlah').val(formatRupiah(jumlah));
        } 
        else if (tipe === 'belanja') {
            var bidang = button.data('bidang');
            var sub_bidang = button.data('sub_bidang');
            var jumlah = button.data('jumlah');
            
            $('#bidangGroup').show();
            $('#subBidangGroup').show();
            $('#editBidang').val(bidang);
            $('#editSubBidang').val(sub_bidang);
            $('#editJumlah').val(formatRupiah(jumlah));
        } 
        else if (tipe === 'pembiayaan') {
            var jenis = button.data('jenis');
            var jumlah = button.data('jumlah');
            
            $('#jenisGroup').show();
            $('#editJenis').val(jenis);
            $('#editJumlah').val(formatRupiah(jumlah));
        }
    });

    // Handler untuk select tahun
    $('#selectTahun').change(function() {
        var tahun = $(this).val();
        window.location.href = 'keuangan.php?tahun=' + tahun;
    });

    // Konfirmasi hapus
    window.confirmDelete = function(tipe, id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = '../php/proses_keuangan.php?action=delete&tipe=' + tipe + '&id=' + id;
        }
    };

    // Handle form submission
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        
        // Convert jumlah back to number before submitting
        var jumlahInput = $('#editJumlah');
        var jumlahValue = parseRupiah(jumlahInput.val());
        jumlahInput.val(jumlahValue);
        
        // Submit the form
        this.submit();
    });
});
</script>
</body>
</html>
