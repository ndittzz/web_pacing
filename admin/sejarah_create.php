<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
?>
<!-- admin/sejarah_edit.php - Tambah/Edit Sejarah Desa -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Sejarah Desa - Desa Pacing</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link
      href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
      rel="stylesheet"
    />
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
              <li class="nav-item">
                <a href="sejarah.php" class="nav-link active">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Manajemen Sejarah</p>
                </a>
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
                <h1 class="m-0">Tambah Sejarah Desa</h1>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <form>
                  <div class="form-group">
                    <label>Tahun</label>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Tahun"
                    />
                  </div>
                  <div class="form-group">
                    <label>Judul</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Judul Peristiwa"
                    />
                  </div>
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <div id="editor-deskripsi" style="height: 150px">
                      Deskripsi peristiwa sejarah...
                    </div>
                    <input
                      type="hidden"
                      name="deskripsi"
                      id="input-deskripsi"
                    />
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="sejarah.php" class="btn btn-secondary">Kembali</a>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
      var quillDeskripsi = new Quill("#editor-deskripsi", { theme: "snow" });
      document.querySelector("form").onsubmit = function (e) {
        document.getElementById("input-deskripsi").value =
          quillDeskripsi.root.innerHTML;
      };
    </script>
  </body>
</html>
