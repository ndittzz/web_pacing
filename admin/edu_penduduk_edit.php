<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
include '../php/db.php';
$error = null;
if (!isset($_GET['id'])) {
    header('Location: penduduk.php');
    exit();
}
$id = intval($_GET['id']);

// Ambil data lama
$result = $konek->query("SELECT * FROM penduduk_pendidikan WHERE id=$id");
if (!$result || $result->num_rows == 0) {
    echo '<div class="alert alert-danger">Data tidak ditemukan.</div>';
    exit();
}
$data = $result->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = $_POST['kategori'];
    $total = $_POST['total'];

    $sql = "UPDATE penduduk_pendidikan SET kategori='$kategori', total='$total' WHERE id=$id";
    if ($konek->query($sql)) {
        header('Location: penduduk.php');
        exit();
    } else {
        $error = 'Gagal mengupdate data: ' . $konek->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Total Data Penduduk Berdasarkan Tingkat Pendidikan - Desa Pacing</title>
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
            </ul>
          </nav>
        </div>
      </aside>
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Total Data Penduduk Berdasarkan Tingkat Pendidikan</h1>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <form method="post" action="edu_penduduk_edit.php?id=<?= $id ?>">
                  <div class="form-group">
                    <label>Tingkat Pendidikan</label>
                    <select class="form-control" id="kategori-pekerjaan" name="kategori">
                      <option value="">Pilih Kategori Pekerjaan</option>
                      <?php
                          $options = [
                            "Tidak Sekolah",
                            "Taman Kanak-Kanak",
                            "SD/Sederajat",
                            "SMP/Sederajat",
                            "SMA/Sederajat",
                            "Akademi (D1 - D3)",
                            "Sarjana (S1 - S3)"
                          ];                        
                          foreach ($options as $opt) {
                          $selected = ($data['kategori'] == $opt) ? 'selected' : '';
                          echo "<option value='$opt' $selected>$opt</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <!-- <div class="form-group">
                    <label>Laki-laki</label>
                    <input
                      type="number"
                      id="laki-laki"
                      class="form-control"
                      placeholder="Masukkan jumlah laki-laki"
                      min="0"
                      value="0"
                    />
                  </div>
                  <div class="form-group">
                    <label>Perempuan</label>
                    <input 
                      type="number" 
                      id="perempuan"
                      class="form-control" 
                      placeholder="Masukkan jumlah perempuan"
                      min="0"
                      value="0"
                    />
                  </div> -->
                  <div class="form-group">
                    <label>Total Penduduk</label>
                    <input
                      type="number"
                      name="total"
                      id="total"
                      value="<?= $data['total']; ?>"
                      class="form-control"
                      placeholder="Total"
                    />
                  </div>
                  
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                  </button>
                  <a href="penduduk.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                  </a>
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
    
    <!-- <script>
      // Fungsi untuk menghitung total otomatis
      function hitungTotal() {
        const lakiLaki = parseInt(document.getElementById('laki-laki').value) || 0;
        const perempuan = parseInt(document.getElementById('perempuan').value) || 0;
        const total = lakiLaki + perempuan;
        
        document.getElementById('total').value = total;
      }
      
      // Event listener untuk input laki-laki
      document.getElementById('laki-laki').addEventListener('input', hitungTotal);
      
      // Event listener untuk input perempuan
      document.getElementById('perempuan').addEventListener('input', hitungTotal);
      
      // Hitung total saat halaman dimuat
      document.addEventListener('DOMContentLoaded', hitungTotal);
    </script> -->
  </body>
</html>