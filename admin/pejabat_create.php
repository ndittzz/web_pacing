<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
include '../php/db.php';
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $konek->real_escape_string($_POST['nama']);
    $tempat_lahir = $konek->real_escape_string($_POST['tempat_lahir']);
    $tanggal_lahir = $konek->real_escape_string($_POST['tanggal_lahir']);
    $jabatan = $konek->real_escape_string($_POST['jabatan']);
    $periode = $konek->real_escape_string($_POST['periode']);
    $kategori = $konek->real_escape_string($_POST['kategori']);
    $riwayat_pendidikan = $konek->real_escape_string($_POST['riwayat_pendidikan']);
    $riwayat_jabatan = $konek->real_escape_string($_POST['riwayat_jabatan']);
    $gambar = null;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $namaFile = 'pejabat_' . time() . '.' . $ext;
        $target = '../assets/' . $namaFile;
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $gambar = $namaFile;
        }
    }
    $sql = "INSERT INTO pejabat (nama, gambar, tempat_lahir, tanggal_lahir, jabatan, periode, kategori, riwayat_pendidikan, riwayat_jabatan) VALUES ('$nama', " . ($gambar ? "'$gambar'" : 'NULL') . ", '$tempat_lahir', '$tanggal_lahir', '$jabatan', '$periode', '$kategori', '$riwayat_pendidikan', '$riwayat_jabatan')";
    if ($konek->query($sql)) {
        header('Location: pejabat.php');
        exit();
    } else {
        $error = 'Gagal menyimpan data: ' . $konek->error;
    }
}
?>
<!-- admin/pejabat_create.php - Create Pejabat -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Pejabat - Desa Pacing</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/dashboard.css" />
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
          </li>
        </ul>
      </nav>
      <aside class="main-sidebar sidebar-red elevation-4">
        <!-- Brand Logo -->
        <a href="../index.php" class="brand-link">
          <img
            src="../assets/klaten.jpg"
            alt="Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
          />
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
                    <a href="potensi.php" class="nav-link active">
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
                <h1 class="m-0">Tambah Pejabat</h1>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="pejabat_create.php">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Pejabat" required />
                  </div>
                  <div class="form-group">
                    <label>Upload Gambar</label>
                    <input type="file" class="form-control-file" name="gambar" accept="image/*" />
                  </div>
                  <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required />
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" required />
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required />
                  </div>
                  <div class="form-group">
                    <label>Periode</label>
                    <input type="text" class="form-control" name="periode" placeholder="2020-2026" required />
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="kategori" required>
                      <option value="">Pilih Kategori</option>
                      <option value="Perangkat Desa">Perangkat Desa</option>
                      <option value="BPD">BPD</option>
                      <option value="Karang Taruna">Karang Taruna</option>
                      <option value="BUMDes">BUMDes</option>
                      <option value="KDMP">KDMP</option>
                      <option value="Kelompok Tani">Kelompok Tani</option>
                      <option value="PKK">PKK</option>
                      <option value="RT/RW">RT/RW</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Riwayat Pendidikan</label>
                    <textarea class="form-control" name="riwayat_pendidikan" rows="2" placeholder="Contoh: SMA Negeri 2 Klaten (2003–2006)\nSI Universitas Atmajaya Yogyakarta (2006–2011)" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Riwayat Jabatan</label>
                    <textarea class="form-control" name="riwayat_jabatan" rows="2" placeholder="Contoh: Anggota DPRD Kabupaten Klaten (2014–2019)\nKetua DPRD Kabupaten Klaten (2019–2024)" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="pejabat.php" class="btn btn-secondary">Kembali</a>
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
