<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
include '../php/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen Sejarah Desa - Desa Pacing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="icon" href="../assets/klaten-removebg.png" type="image/png">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="dashboard.php" class="nav-link">Dashboard</a>
            </li>
        </ul>
    </nav>
    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-red elevation-4">
        <a href="../index.php" class="brand-link">
            <div class="flex items-center space-x-2">
              <img
                alt="Logo Pemerintah Desa Pacing"
                class="block"
                height="28"
                src="../assets/klaten-removebg.png"
                width="28"
              />
              <span class="text-red-800 text-base">Desa Pacing, Klaten</span>
            </div>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>Profil <i class="right fas fa-angle-left"></i></p>
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
                                <a href="sejarah.php" class="nav-link active">
                                    <i class="fas fa-history nav-icon"></i>
                                    <p>Manajemen Sejarah</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>Data Desa <i class="right fas fa-angle-left"></i></p>
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
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>Informasi Desa <i class="right fas fa-angle-left"></i></p>
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
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>Publikasi <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="agenda.php" class="nav-link">
                                    <i class="far fa-calendar-alt nav-icon"></i>
                                    <p>Manajemen Agenda</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pengumuman.php" class="nav-link">
                                    <i class="fas fa-volume-up nav-icon"></i>
                                    <p>Manajemen Pengumuman</p>
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
                        <h1 class="m-0">Manajemen Sejarah Desa</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <!-- Legenda Desa -->
                <?php
                $legenda = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM sejarah_desa WHERE bagian='legenda' LIMIT 1"));
                ?>
                <div class="card mb-4">
                    <div class="card-header bg-info">
                        <h5 class="card-title">Legenda Desa</h5>
                        <a href="sejarah_edit_legenda.php" class="btn btn-warning btn-sm float-right">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <?php if ($legenda && $legenda['gambar']) { ?>
                                    <img src="../assets/<?= $legenda['gambar'] ?>" alt="Legenda Desa" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto" />
                                <?php } ?>
                            </div>
                            <div class="col-md-8">
                                <p><?= nl2br($legenda['konten'] ?? '') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sejarah Umum -->
                <?php
                $sejarah_umum = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM sejarah_desa WHERE bagian='sejarah_umum' LIMIT 1"));
                ?>
                <div class="card mb-4">
                    <div class="card-header bg-success">
                        <h5 class="card-title">Sejarah Umum</h5>
                        <a href="sejarah_edit_umum.php" class="btn btn-warning btn-sm float-right">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                    <div class="card-body">
                        <p><?= nl2br($sejarah_umum['konten'] ?? '') ?></p>
                    </div>
                </div>
                <!-- Daftar Kepala Desa -->
                <div class="card mb-4">
                    <div class="card-header bg-warning">
                        <h5 class="card-title">Daftar Kepala Desa</h5>
                        <a href="sejarah_kepaladesa_create.php" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Periode</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $kepala = mysqli_query($konek, "SELECT * FROM tokoh_sejarah ORDER BY id ASC");
                                while ($d = mysqli_fetch_assoc($kepala)) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($d['nama']) ?></td>
                                    <td><?= htmlspecialchars($d['alamat']) ?></td>
                                    <td><?= htmlspecialchars($d['periode']) ?></td>
                                    <td><?= htmlspecialchars($d['keterangan']) ?></td>
                                    <td>
                                        <a href="sejarah_kepaladesa_edit.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <a href="sejarah_kepaladesa_delete.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Penutup -->
                <?php
                $penutup = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM sejarah_desa WHERE bagian='penutup' LIMIT 1"));
                ?>
                <div class="card mb-4">
                    <div class="card-header bg-secondary">
                        <h5 class="card-title">Penutup</h5>
                        <a href="sejarah_edit_penutup.php" class="btn btn-warning btn-sm float-right">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                    <div class="card-body">
                        <p><?= nl2br($penutup['konten'] ?? '') ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block"><b>Version</b> 1.0</div>
        <strong>Desa Pacing</strong> All rights reserved.
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>