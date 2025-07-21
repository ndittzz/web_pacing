<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}
include '../php/db.php';

$message = '';
$error = '';
$berita = null;

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing data
if ($id > 0) {
    $stmt = $konek->prepare("SELECT * FROM berita WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $berita = $result->fetch_assoc();
    
    if (!$berita) {
        header('Location: berita.php?error=Data tidak ditemukan');
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $berita) {
    $judul = $_POST['judul'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $penulis = $_POST['penulis'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $gambar = $berita['gambar']; // Keep existing image by default

    // Handle file upload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $uploadDir = '../assets/';
        $fileName = time() . '_' . basename($_FILES['gambar']['name']);
        $uploadPath = $uploadDir . $fileName;
        
        // Check file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (in_array($_FILES['gambar']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadPath)) {
                // Delete old image if exists
                if ($berita['gambar'] && file_exists($uploadDir . $berita['gambar'])) {
                    unlink($uploadDir . $berita['gambar']);
                }
                $gambar = $fileName;
            } else {
                $error = 'Gagal mengupload gambar.';
            }
        } else {
            $error = 'Format gambar tidak valid. Gunakan JPG, PNG, atau GIF.';
        }
    }

    // Update data if no errors
    if (empty($error)) {
        $stmt = $konek->prepare("UPDATE berita SET judul = ?, deskripsi = ?, gambar = ?, tanggal = ?, penulis = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $judul, $deskripsi, $gambar, $tanggal, $penulis, $id);
        
        if ($stmt->execute()) {
            header('Location: berita.php?success=Data berhasil diupdate');
            exit();
        } else {
            $error = 'Gagal mengupdate data: ' . $konek->error;
        }
    }
}

// Redirect if no valid ID
if (!$berita) {
    header('Location: berita.php');
    exit();
}
?>
<!-- admin/berita_edit.php - Edit Berita -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Berita - Desa Pacing</title>
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
                    <a href="berita.php" class="nav-link active">
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
                <h1 class="m-0">Edit Berita</h1>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
          <div class="container-fluid">
            <?php if ($error): ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>
            
            <div class="card">
              <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Judul <span class="text-danger">*</span></label>
                    <input
                      type="text"
                      name="judul"
                      class="form-control"
                      placeholder="Judul Berita"
                      value="<?php echo htmlspecialchars($berita['judul']); ?>"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label>Deskripsi <span class="text-danger">*</span></label>
                    <textarea
                      name="deskripsi"
                      class="form-control"
                      rows="5"
                      placeholder="Isi Berita"
                      required
                    ><?php echo htmlspecialchars($berita['deskripsi']); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Penulis <span class="text-danger">*</span></label>
                    <input
                      type="text"
                      name="penulis"
                      class="form-control"
                      placeholder="Nama Penulis"
                      value="<?php echo htmlspecialchars($berita['penulis']); ?>"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label>Upload Gambar</label>
                    <?php if ($berita['gambar']): ?>
                      <div class="mb-2">
                        <img src="../assets/<?php echo htmlspecialchars($berita['gambar']); ?>" 
                             alt="Current Image" 
                             style="max-width: 200px; max-height: 150px;" 
                             class="img-thumbnail">
                        <small class="text-muted d-block">Gambar saat ini</small>
                      </div>
                    <?php endif; ?>
                    <input type="file" name="gambar" class="form-control-file" accept="image/*" />
                    <small class="form-text text-muted">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                  </div>
                  <div class="form-group">
                    <label>Tanggal <span class="text-danger">*</span></label>
                    <input 
                      type="date" 
                      name="tanggal" 
                      class="form-control" 
                      value="<?php echo htmlspecialchars($berita['tanggal']); ?>"
                      required
                    />
                  </div>
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                  </button>
                  <a href="berita.php" class="btn btn-secondary">
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
  </body>
</html>