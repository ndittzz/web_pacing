<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
include '../php/db.php';
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $kegiatan = $konek->real_escape_string($_POST['kegiatan']);
    $tempat = $konek->real_escape_string($_POST['tempat']);
    $hadir = $konek->real_escape_string($_POST['hadir']);
    $sql = "INSERT INTO agenda (tanggal, jam_mulai, jam_selesai, kegiatan, tempat, hadir) VALUES ('$tanggal', '$jam_mulai', '$jam_selesai', '$kegiatan', '$tempat', '$hadir')";
    if ($konek->query($sql)) {
        header('Location: agenda.php');
        exit();
    } else {
        $error = 'Gagal menambah agenda: ' . $konek->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Agenda - Desa Pacing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
    <aside class="main-sidebar sidebar-red elevation-4">
        <a href="../index.php" class="brand-link">
            <img src="../assets/klaten.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
            <span class="brand-text font-weight-light">Desa Pacing</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">
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
                    <!-- Publikasi Dropdown -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>
                                Publikasi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="agenda.php" class="nav-link active">
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
                        <h1 class="m-0">Tambah Agenda</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                            </div>
                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" required />
                            </div>
                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" required />
                            </div>
                            <div class="form-group">
                                <label for="kegiatan">Kegiatan</label>
                                <input type="text" class="form-control" name="kegiatan" id="kegiatan" required />
                            </div>
                            <div class="form-group">
                                <label for="tempat">Tempat</label>
                                <input type="text" class="form-control" name="tempat" id="tempat" required />
                            </div>
                            <div class="form-group">
                                <label for="hadir">Hadir</label>
                                <input type="text" class="form-control" name="hadir" id="hadir" />
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="agenda.php" class="btn btn-secondary">Batal</a>
                        </form>
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