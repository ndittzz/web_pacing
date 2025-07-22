<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
?>

<!-- admin/index.php - Dashboard AdminLTE Desa Pacing -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Desa Pacing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="icon" href="../assets/klaten-removebg.png" type="image/png">
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard.php" class="nav-link">Dashboard</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="../php/logout.php" class="nav-link text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </nav>


      <!-- Sidebar -->
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

        <!-- Sidebar Menu -->
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

      <!-- Content Wrapper -->
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard Admin Desa Pacing</h1>
              </div>
            </div>
          </div>
        </div>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>12</h3>
                    <p>Total Berita</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-newspaper"></i>
                  </div>
                  <a href="berita.php" class="small-box-footer"
                    >Lihat Detail <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>5</h3>
                    <p>Total Pejabat</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-tie"></i>
                  </div>
                  <a href="pejabat.php" class="small-box-footer"
                    >Lihat Detail <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>1</h3>
                    <p>Visi Misi</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-bullseye"></i>
                  </div>
                  <a href="visimisi.php" class="small-box-footer"
                    >Lihat Detail <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>8</h3>
                    <p>Total Agenda</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                  </div>
                  <a href="agenda.php" class="small-box-footer"
                    >Lihat Detail <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>6</h3>
                    <p>Total Pengumuman</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-megaphone"></i>
                  </div>
                  <a href="pengumuman.php" class="small-box-footer"
                    >Lihat Detail <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <footer class="main-footer">
        <div class="float-right">
          <b>Version</b> 1.0
          <!-- Ikon tanda seru sebagai trigger modal -->
          <i class="fas fa-exclamation-circle text-danger ml-2" style="cursor: pointer;" data-toggle="modal" data-target="#fotoModal" title="Lihat Foto"></i>
        </div>
        <strong>Desa Pacing</strong> All rights reserved.
      </footer>

          <!-- Modal -->
        <div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content border-0 shadow-lg">
              <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="fotoModalLabel">
                  <i class="fas fa-images mr-2"></i>KKN UPN "VETERAN" YOGYAKARTA DI DESA PACING
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body p-4">
                <div class="row">
                  <!-- Image 1 with caption -->
                  <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                      <img src="../assets/kenangan/kenangan2.jpg" class="card-img-top img-fluid gallery-img" alt="Kenangan Desa">
                      <div class="card-body text-center">
                        <p class="card-text text-muted">KKN AD.83.244</p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Image 2 with caption -->
                  <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                      <img src="../assets/kenangan/kenangan.jpg" class="card-img-top img-fluid gallery-img" alt="Kenangan Desa">
                      <div class="card-body text-center">
                        <p class="card-text text-muted">KKN AD.83.245</p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Image 3 with caption -->
                  <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                      <img src="../assets/kenangan/kenangan1.jpg" class="card-img-top img-fluid gallery-img" alt="Kenangan Desa">
                      <div class="card-body text-center">
                        <p class="card-text text-muted">KKN AD.83.246</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <style>
      /* Custom Gallery Styles */
      .gallery-img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
      }
      .gallery-img:hover {
        transform: scale(1.03);
      }
      .modal-xl {
        max-width: 1140px;
      }
    </style>

    <script>
    $(document).ready(function() {
      // Smooth modal open/close
      $('.fa-exclamation-circle').click(function() {
        $('#fotoModal').modal('show');
      });
      
      // Close modal when X is clicked
      $('[data-dismiss="modal"]').click(function() {
        $('#fotoModal').modal('hide');
      });
      
      // Close when clicking outside modal
      $('#fotoModal').click(function(event) {
        if ($(event.target).is('#fotoModal')) {
          $(this).modal('hide');
        }
      });
    });
    </script>
  </body>
</html>