<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Keuangan Desa - Pemerintah Desa Pacing</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/dashboard.css" />
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard.php" class="nav-link">Dashboard</a>
                </li>
            </ul>
        </nav>
        
        <aside class="main-sidebar sidebar-red elevation-4">
            <!-- Brand Logo -->
            <a href="../index.php" class="brand-link">
                <img src="../assets/klaten.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Desa Pacing</span>
            </a>

            <!-- Sidebar Menu -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Data Keuangan</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahunPendapatan">Tahun Anggaran</label>
                        <input
                            type="number"
                            class="form-control"
                            id="tahunPendapatan"
                            name="tahunPendapatan"
                            value="2024"
                            required
                        />
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <ul class="nav nav-pills mb-3" id="custom-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pendapatan-tab" data-toggle="pill" href="#pendapatan" role="tab">
                                        <i class="fas fa-money-bill-wave mr-2"></i>Pendapatan Desa
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="belanja-tab" data-toggle="pill" href="#belanja" role="tab">
                                        <i class="fas fa-hand-holding-usd mr-2"></i>Belanja Desa
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pembiayaan-tab" data-toggle="pill" href="#pembiayaan" role="tab">
                                        <i class="fas fa-exchange-alt mr-2"></i>Pembiayaan
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabsContent">
                                <!-- Form Pendapatan Desa -->
                                <div class="tab-pane fade show active" id="pendapatan" role="tabpanel">
                                      <form id="formPendapatan" name="pendapatan" action="../php/proses_keuangan.php?action=pendapatan" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kategoriPendapatan">Kategori Pendapatan</label>
                                                    <select class="form-control" id="kategoriPendapatan" name="kategoriPendapatan" required>
                                                        <option value="">Pilih Kategori</option>
                                                        <option value="Pendapatan Asli Desa">Pendapatan Asli Desa</option>
                                                        <option value="Dana Desa">Dana Desa</option>
                                                        <option value="Bagi Hasil Pajak dan Retribusi">Bagi Hasil Pajak dan Retribusi</option>
                                                        <option value="Alokasi Dana Desa">Alokasi Dana Desa</option>
                                                        <option value="Bantuan Provinsi">Bantuan Provinsi</option>
                                                        <option value="Bantuan Kabupaten">Bantuan Kabupaten</option>
                                                        <option value="Pendapatan Lainnya">Pendapatan Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jumlahPendapatan">Jumlah (Rp)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp</span>
                                                        </div>
                                                        <input
                                                            type="text"
                                                            class="form-control currency-input"
                                                            name="jumlahPendapatan"
                                                            id="jumlahPendapatan"
                                                            placeholder="0"
                                                            required
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                      

                                        <div class="form-group text-right">
                                            <button type="button" class="btn btn-secondary mr-2">
                                                Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save mr-1"></i> Simpan Pendapatan
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Form Belanja Desa -->
                                <div class="tab-pane fade" id="belanja" role="tabpanel">
                                      <form id="formBelanja" name="belanja" action="../php/proses_keuangan.php?action=belanja" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bidangBelanja">Bidang Belanja</label>
                                                    <select class="form-control" id="bidangBelanja" name="bidangBelanja" required>
                                                        <option value="">Pilih Bidang</option>
                                                        <option value="Penyelenggaraan Pemerintahan">Penyelenggaraan Pemerintahan</option>
                                                        <option value="Pelaksanaan Pembangunan">Pelaksanaan Pembangunan</option>
                                                        <option value="Pembinaan Kemasyarakatan">Pembinaan Kemasyarakatan</option>
                                                        <option value="Pemberdayaan Masyarakat">Pemberdayaan Masyarakat</option>
                                                        <option value="Penanggulangan Bencana">Penanggulangan Bencana</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="subBidangBelanja">Sub Bidang</label>
                                                    <select class="form-control" id="subBidangBelanja" name="subBidangBelanja" required>
                                                        <option value="">Pilih Sub Bidang</option>
                                                        <option value="Belanja Siltap, Tunjangan dan Operasional Pemdes">Belanja Siltap, Tunjangan dan Operasional Pemdes</option>
                                                        <option value="Tata Praja Pemerintahan, Perencanaan, Keuangan dan Pelaporan">Tata Praja Pemerintahan, Perencanaan, Keuangan dan Pelaporan</option>
                                                        <option value="Sub Bidang Pertahanan">Sub Bidang Pertahanan</option>
                                                        <option value="Sub Bidang Pendidikan">Sub Bidang Pendidikan</option>
                                                        <option value="Sub Bidang Kesehatan">Sub Bidang Kesehatan</option>
                                                        <option value="Sub Bidang Pekerjaan Umum dan Penataan Ruang">Sub Bidang Pekerjaan Umum dan Penataan Ruang</option>
                                                        <option value="Sub Bidang Kawasan Pemukiman">Sub Bidang Kawasan Pemukiman</option>
                                                        <option value="Sub Bidang Perhubungan, Komunikasi dan Informatika">Sub Bidang Perhubungan, Komunikasi dan Informatika</option>
                                                        <option value="Sub Bidang Ketenteraman, Ketertiban Umum dan Perlindungan Masyarakat">Sub Bidang Ketenteraman, Ketertiban Umum dan Perlindungan Masyarakat</option>
                                                        <option value="Sub Bidang Kebudayaan dan Keagamaan">Sub Bidang Kebudayaan dan Keagamaan</option>
                                                        <option value="Sub Bidang Kelembagaan Masyarakat">Sub Bidang Kelembagaan Masyarakat</option>
                                                        <option value="Sub Bidang Pertanian dan Peternakan">Sub Bidang Pertanian dan Peternakan</option>
                                                        <option value="Sub Bidang Peningkatan Kapasitas Aparatur Desa">Sub Bidang Peningkatan Kapasitas Aparatur Desa</option>
                                                        <option value="Sub Bidang Keadaan Darurat">Sub Bidang Keadaan Darurat</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="jumlahBelanja">Jumlah (Rp)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input
                                                                type="text"
                                                                class="form-control currency-input"
                                                                id="jumlahBelanja"
                                                                name="jumlahBelanja"
                                                                placeholder="0"
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                        
                                        <div class="form-group text-right">
                                            <button type="button" class="btn btn-secondary mr-2">
                                                Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save mr-1"></i> Simpan Belanja
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Form Pembiayaan -->
                                <div class="tab-pane fade" id="pembiayaan" role="tabpanel">
                                      <form id="formPembiayaan" name="pembiayaan" action="../php/proses_keuangan.php?action=pembiayaan" method="POST">
                                        <div class="row">                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jenisPembiayaan">Jenis Pembiayaan</label>
                                                    <select class="form-control" id="jenisPembiayaan" name="jenisPembiayaan" required>
                                                        <option value="">Pilih Jenis</option>
                                                        <option value="penerimaan">Penerimaan Pembiayaan</option>
                                                        <option value="pengeluaran">Pengeluaran Pembiayaan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jumlahPembiayaan">Jumlah (Rp)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp</span>
                                                        </div>
                                                        <input
                                                            type="text"
                                                            class="form-control currency-input"
                                                            id="jumlahPembiayaan"
                                                            name="jumlahPembiayaan"
                                                            placeholder="0"
                                                            required
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="form-group text-right">
                                            <button type="button" class="btn btn-secondary mr-2">
                                                Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save mr-1"></i> Simpan Pembiayaan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
<script>
    $(document).ready(function () {
        // Inisialisasi tab
        $('#custom-tabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // Format input mata uang
        $(".currency-input").on("keyup", function () {
            let value = $(this).val().replace(/[^\d]/g, "");
            $(this).val(formatRupiah(value));
        });

        // Fungsi format rupiah
        function formatRupiah(angka) {
            if (!angka) return "";
            let number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            return rupiah;
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type = 'success') {
            const notification = $(`<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`);
            
            // Tambahkan notifikasi di atas konten
            $('.content-wrapper').prepend(notification);
            
            // Hilangkan notifikasi setelah 5 detik
            setTimeout(() => {
                notification.alert('close');
            }, 5000);
        }

        // Submit form pendapatan dengan AJAX
        $("#formPendapatan").submit(function (e) {
            e.preventDefault();
            
            // Ambil data form
            const formData = {
                tahunPendapatan: $('#tahunPendapatan').val(),
                kategoriPendapatan: $('#kategoriPendapatan').val(),
                jumlahPendapatan: $('#jumlahPendapatan').val().replace(/\./g, '')
            };

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response); // Tambahkan ini
                    showNotification("Data pendapatan berhasil disimpan!");
                    // Reset form setelah berhasil disimpan
                    $('#formPendapatan')[0].reset();
                },
                error: function(xhr, status, error) {
                    showNotification("Terjadi kesalahan saat menyimpan data pendapatan!", 'danger');
                    console.error(error);
                }
            });
        });

        // Submit form belanja dengan AJAX
        $("#formBelanja").submit(function (e) {
            e.preventDefault();
            
            // Ambil data form
            const formData = {
                tahunPendapatan: $('#tahunPendapatan').val(),
                bidangBelanja: $('#bidangBelanja').val(),
                subBidangBelanja: $('#subBidangBelanja').val(),
                jumlahBelanja: $('#jumlahBelanja').val().replace(/\./g, '')
            };

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    showNotification("Data belanja berhasil disimpan!");
                    // Reset form setelah berhasil disimpan
                    $('#formBelanja')[0].reset();
                },
                error: function(xhr, status, error) {
                    showNotification("Terjadi kesalahan saat menyimpan data belanja!", 'danger');
                    console.error(error);
                }
            });
        });

        // Submit form pembiayaan dengan AJAX
        $("#formPembiayaan").submit(function (e) {
            e.preventDefault();
            
            // Ambil data form
            const formData = {
                tahunPendapatan: $('#tahunPendapatan').val(),
                jenisPembiayaan: $('#jenisPembiayaan').val(),
                jumlahPembiayaan: $('#jumlahPembiayaan').val().replace(/\./g, '')
            };

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    showNotification("Data pembiayaan berhasil disimpan!");
                    // Reset form setelah berhasil disimpan
                    $('#formPembiayaan')[0].reset();
                },
                error: function(xhr, status, error) {
                    showNotification("Terjadi kesalahan saat menyimpan data pembiayaan!", 'danger');
                    console.error(error);
                }
            });
        });

        // Tombol reset
        $('button[type="button"]').click(function () {
            $(this).closest("form")[0].reset();
        });
    });
</script>
</body>
</html>