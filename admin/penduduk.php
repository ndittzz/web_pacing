<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
include '../php/db.php';
$result = $konek->query(query: "SELECT * FROM penduduk_kelamin");
$result2 = $konek->query(query: "SELECT * FROM penduduk_usia ORDER BY id ASC");
$result3 = $konek->query(query: "SELECT * FROM penduduk_pekerjaan ORDER BY id ASC");
$result4 = $konek->query(query: "SELECT * FROM penduduk_pendidikan ORDER BY id ASC");

?>
<!-- admin/penduduk.php - Dashboard Manajemen Data Penduduk -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen Data Penduduk - Desa Pacing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="icon" href="../assets/klaten-removebg.png" type="image/png">
    <style>
      /* Custom styles for delete modal */
      .modal-header.bg-danger {
        background-color: #dc3545 !important;
        color: white;
      }
      .modal-footer .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
      }
      .modal-footer .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
      }
    </style>
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
      <!-- Sidebar -->
      <aside class="main-sidebar sidebar-red elevation-4">
        <!-- Brand Logo -->
        <a href="../index.php" class="brand-link">
          <div class="flex items-center space-x-2">
            <img
              alt="Logo Pemerintah Desa Pacing"
              class="block"
              height="28"
              src="../assets/klaten-removebg.png"
              width="28"
            />
            <span class="text-red-800 text-base">Desa Pacing</span>
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
                    <a href="penduduk.php" class="nav-link active">
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
                <h1 class="m-0">Manajemen Data Penduduk</h1>
              </div>
              <div class="col-sm-6 text-right">
              </div>
            </div>
          </div>
        </div>
        
        <section class="content">
          <div class="container-fluid">
            <!-- Tabel Berdasarkan Jenis Kelamin -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-venus-mars"></i> Data Berdasarkan Jenis Kelamin</h3>
                <div class="card-tools">
                  <button class="btn btn-primary btn-sm">
                    <a href="gender_penduduk_create.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                    </a>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Laki-laki</th>
                      <th>Perempuan</th>
                      <th>Total</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                 <tbody>
                  <?php 
                    $no = 1; // Ditaruh di sini, sebelum loop
                    while ($row = $result->fetch_assoc()): 
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $row['laki_laki']; ?></td>
                      <td><?php echo $row['perempuan']; ?></td>
                      <td><?php echo $row['total']; ?></td>
                      <td>
                        <a href="gender_penduduk_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="../php/gender_delete.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>

                </table>
              </div>
            </div>

            <!-- Tabel Berdasarkan Usia -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-birthday-cake"></i> Data Berdasarkan Usia</h3>
                <div class="card-tools">
                  <button class="btn btn-primary btn-sm">
                    <a href="age_penduduk_create.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                    </a>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kategori Usia</th>
                      <th>Total</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      while ($row = $result2->fetch_assoc()): ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= htmlspecialchars($row['kategori']); ?> tahun</td>
                          <td><?= $row['total']; ?></td>
                          <td>
                            <a href="age_penduduk_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a 
                              href="../php/age_delete.php?id=<?= $row['id']; ?>" 
                              class="btn btn-danger btn-sm"
                              onclick="return confirm('Yakin ingin menghapus data ini?')"
                            >
                              <i class="fas fa-trash"></i>
                            </a>

                          </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>

                </table>
              </div>
            </div>

            <!-- Tabel Berdasarkan Pendidikan -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-graduation-cap"></i> Data Berdasarkan Pendidikan</h3>
                <div class="card-tools">
                  <button class="btn btn-primary btn-sm">
                    <a href="edu_penduduk_create.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                    </a>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tingkat Pendidikan</th>
                      <th>Total</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $no = 1;
                      while ($row = $result4->fetch_assoc()): ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= htmlspecialchars($row['kategori']); ?></td>
                          <td><?= $row['total']; ?></td>
                          <td>
                            <a href="edu_penduduk_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a 
                              href="../php/edu_delete.php?id=<?= $row['id']; ?>" 
                              class="btn btn-danger btn-sm"
                              onclick="return confirm('Yakin ingin menghapus data ini?')"
                            >
                              <i class="fas fa-trash"></i>
                            </a>

                          </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                </table>
              </div>
            </div>

            <!-- Tabel Berdasarkan Pekerjaan -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-briefcase"></i> Data Berdasarkan Pekerjaan</h3>
                <div class="card-tools">
                  <button class="btn btn-primary btn-sm">
                    <a href="job_penduduk_create.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                    </a>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis Pekerjaan</th>
                      <th>Total</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $no = 1;
                      while ($row = $result3->fetch_assoc()): ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= htmlspecialchars($row['kategori']); ?> </td>
                          <td><?= $row['total']; ?></td>
                          <td>
                            <a href="job_penduduk_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a 
                              href="../php/job_delete.php?id=<?= $row['id']; ?>" 
                              class="btn btn-danger btn-sm"
                              onclick="return confirm('Yakin ingin menghapus data ini?')"
                            >
                              <i class="fas fa-trash"></i>
                            </a>

                          </td>
                        </tr>
                      <?php endwhile; ?>
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

    <!-- Delete Confirmation Modal
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title" id="deleteModalLabel">
              <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <i class="fas fa-trash-alt fa-4x text-danger mb-3"></i>
              <h5>Apakah Anda yakin ingin menghapus data ini?</h5>
              <p class="text-muted">Data <strong id="deleteItemName"></strong> akan dihapus secara permanen dan tidak dapat dikembalikan.</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-times"></i> Batal
            </button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
              <i class="fas fa-trash"></i> Hapus Data
            </button>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Success Alert Modal
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title text-white" id="successModalLabel">
              <i class="fas fa-check-circle"></i> Berhasil
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
            <h5>Data berhasil dihapus!</h5>
            <p class="text-muted">Data telah dihapus dari sistem.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">
              <i class="fas fa-check"></i> OK
            </button>
          </div>
        </div>
      </div>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    

  </body>
</html>