<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
include '../php/db.php';
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visi = $konek->real_escape_string($_POST['visi']);
    $misi = $konek->real_escape_string($_POST['misi']);

    $sql = "INSERT INTO visimisi (visi, misi) VALUES ('$visi', '$misi')";
    if ($konek->query($sql)) {
        header('Location: visimisi.php');
        exit();
    } else {
        $error = 'Gagal menyimpan data: ' . $konek->error;
    }
}
?>

<!-- admin/visimisi_create.php - Create Visi Misi -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Visi Misi - Desa Pacing</title>

    <!-- Admin‑LTE & FontAwesome -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css"
    />

    <!-- Quill -->
    <link
      rel="stylesheet"
      href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
    />

    <link rel="stylesheet" href="../css/dashboard.css" />
    <style>
      /* tinggi editor */
      .ql-editor {
        min-height: 180px;
      }
    </style>
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- ===== Navbar ===== -->
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

      <!-- ===== Sidebar ===== -->
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

      <!-- ===== Content ===== -->
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6"><h1 class="m-0">Tambah Visi Misi</h1></div>
            </div>
          </div>
        </div>

        <section class="content">
          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <!-- ===== Form ===== -->
                <?php if ($error) echo '<div class="alert alert-danger">'.$error.'</div>'; ?>
                <form
                  method="POST"
                  id="form-visimisi"
                  action="visimisi_create.php"
                >
                  <!-- === Visi === -->
                  <div class="form-group">
                    <label><strong>Visi</strong></label>
                    <div id="editor-visi" class="border"></div>
                    <input type="hidden" name="visi" id="input-visi" />
                  </div>

                  <!-- === Misi === -->
                  <div class="form-group">
                    <label><strong>Misi</strong></label>
                    <div id="editor-misi" class="border"></div>
                    <input type="hidden" name="misi" id="input-misi" />
                  </div>

                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="visimisi.php" class="btn btn-secondary">Kembali</a>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- ===== Footer ===== -->
      <footer class="main-footer">
        <div class="float-right d-none d-sm-block"><b>Version</b> 1.0</div>
        <strong>Desa Pacing</strong> All rights reserved.
      </footer>
    </div>

    <!-- ===== Scripts ===== -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
      /* Inisialisasi Quill */
      const quillVisi = new Quill("#editor-visi", { theme: "snow" });
      const quillMisi = new Quill("#editor-misi", { theme: "snow" });

      /* Saat form disubmit, masukkan HTML editor ke input hidden */
      document
        .getElementById("form-visimisi")
        .addEventListener("submit", function (e) {
          document.getElementById("input-visi").value =
            quillVisi.root.innerHTML.trim();
          document.getElementById("input-misi").value =
            quillMisi.root.innerHTML.trim();
          /* Tambahkan validasi jika perlu ‑ contoh:
        if(!quillVisi.getText().trim()) { e.preventDefault(); alert("Visi wajib diisi!"); }
        */
        });
    </script>
  </body>
</html>
