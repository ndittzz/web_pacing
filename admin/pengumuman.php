<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
include '../php/db.php';

// Proses delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($id > 0) {
        // Ambil nama file gambar sebelum dihapus
        $result = mysqli_query($konek, "SELECT gambar FROM pengumuman WHERE id=$id");
        if ($row = mysqli_fetch_assoc($result)) {
            $gambar = $row['gambar'];
            // Hapus file gambar jika ada
            if (!empty($gambar) && file_exists('../assets/' . $gambar)) {
                unlink('../assets/' . $gambar);
            }
        }
        mysqli_query($konek, "DELETE FROM pengumuman WHERE id=$id");
    }
    header('Location: pengumuman.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen Pengumuman - Desa Pacing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
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
            <img src="../assets/klaten.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
            <span class="brand-text font-weight-light">Desa Pacing</span>
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
                                <a href="sejarah.php" class="nav-link">
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
                        <a href="#" class="nav-link active">
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
                                <a href="pengumuman.php" class="nav-link active">
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
                        <h1 class="m-0">Manajemen Pengumuman</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="pengumuman_create.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Pengumuman
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pengumuman</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Konten</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $pengumuman = mysqli_query($konek, "SELECT * FROM pengumuman ORDER BY tanggal DESC");
                                while ($d = mysqli_fetch_assoc($pengumuman)) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php if (!empty($d['gambar'])) { ?>
                                            <img src="../assets/<?= $d['gambar'] ?>" alt="Gambar Pengumuman" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                        <?php } else { ?>
                                            <span class="text-muted">Tidak ada gambar</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= htmlspecialchars($d['judul']) ?></td>
                                    <td><?= date('d M Y', strtotime($d['tanggal'])) ?></td>
                                    <td><?= htmlspecialchars_decode(substr(strip_tags($d['konten']), 0, 100)) ?>...</td>
                                    <td>
                                        <a href="pengumuman_edit.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <a href="pengumuman.php?delete=<?= $d['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pengumuman ini?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
