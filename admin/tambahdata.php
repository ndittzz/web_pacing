<!-- admin/kk_edit.php - Edit Data KK -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Data Keuangan - Desa Pacing</title>
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
        </div>
        <section class="content">
          <div class="container-fluid">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <ul class="nav nav-pills mb-3" id="custom-tabs" role="tablist">
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      id="pendapatan-tab"
                      data-bs-toggle="tab"
                      href="#pendapatan"
                      role="tab"
                    >
                      <i class="fas fa-money-bill-wave mr-2"></i>Pendapatan Desa
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="belanja-tab"
                      data-bs-toggle="tab"
                      href="#belanja"
                      role="tab"
                    >
                      <i class="fas fa-hand-holding-usd mr-2"></i>Belanja Desa
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="pembiayaan-tab"
                      data-bs-toggle="tab"
                      href="#pembiayaan"
                      role="tab"
                    >
                      <i class="fas fa-exchange-alt mr-2"></i>Pembiayaan
                    </a>
                  </li>
                </ul>
              </div>

              <div class="card-body">
                <div class="tab-content" id="custom-tabsContent">
                  <!-- Form Pendapatan Desa -->
                  <div
                    class="tab-pane fade show active"
                    id="pendapatan"
                    role="tabpanel"
                  >
                    <form id="formPendapatan">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tahunPendapatan">Tahun Anggaran</label>
                            <input
                              type="number"
                              class="form-control"
                              id="tahunPendapatan"
                              value="2024"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="kategoriPendapatan"
                              >Kategori Pendapatan</label
                            >
                            <select
                              class="form-control"
                              id="kategoriPendapatan"
                              required
                            >
                              <option value="">Pilih Kategori</option>
                              <option value="asli">Pendapatan Asli Desa</option>
                              <option value="dana">Dana Desa</option>
                              <option value="pajak">
                                Bagi Hasil Pajak & Retribusi
                              </option>
                              <option value="add">Alokasi Dana Desa</option>
                              <option value="provinsi">Bantuan Provinsi</option>
                              <option value="kabupaten">
                                Bantuan Kabupaten
                              </option>
                              <option value="lainnya">
                                Pendapatan Lainnya
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="uraianPendapatan">Uraian Pendapatan</label>
                        <input
                          type="text"
                          class="form-control"
                          id="uraianPendapatan"
                          placeholder="Contoh: Hasil Usaha Desa"
                          required
                        />
                      </div>

                      <div class="row">
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
                                id="jumlahPendapatan"
                                placeholder="0"
                                required
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tanggalPendapatan"
                              >Tanggal Penerimaan</label
                            >
                            <input
                              type="date"
                              class="form-control"
                              id="tanggalPendapatan"
                              required
                            />
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="keteranganPendapatan"
                          >Keterangan Tambahan</label
                        >
                        <textarea
                          class="form-control"
                          id="keteranganPendapatan"
                          rows="3"
                        ></textarea>
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
                    <form id="formBelanja">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tahunBelanja">Tahun Anggaran</label>
                            <input
                              type="number"
                              class="form-control"
                              id="tahunBelanja"
                              value="2024"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="bidangBelanja">Bidang Belanja</label>
                            <select
                              class="form-control"
                              id="bidangBelanja"
                              required
                            >
                              <option value="">Pilih Bidang</option>
                              <option value="pemerintahan">
                                Penyelenggaraan Pemerintahan
                              </option>
                              <option value="pembangunan">
                                Pelaksanaan Pembangunan
                              </option>
                              <option value="pembinaan">
                                Pembinaan Kemasyarakatan
                              </option>
                              <option value="pemberdayaan">
                                Pemberdayaan Masyarakat
                              </option>
                              <option value="bencana">
                                Penanggulangan Bencana
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="subBidangBelanja">Sub Bidang</label>
                        <select
                          class="form-control"
                          id="subBidangBelanja"
                          required
                        >
                          <option value="">Pilih Sub Bidang</option>
                          <option value="operasional">
                            Operasional Pemerintah Desa
                          </option>
                          <option value="pertanahan">Pertanahan</option>
                          <option value="pendidikan">Pendidikan</option>
                          <option value="kesehatan">Kesehatan</option>
                          <option value="pekerjaan">Pekerjaan Umum</option>
                          <option value="pemukiman">Kawasan Pemukiman</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="uraianBelanja">Uraian Kegiatan</label>
                        <textarea
                          class="form-control"
                          id="uraianBelanja"
                          rows="2"
                          required
                        ></textarea>
                      </div>

                      <div class="row">
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
                                placeholder="0"
                                required
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tanggalBelanja"
                              >Tanggal Pengeluaran</label
                            >
                            <input
                              type="date"
                              class="form-control"
                              id="tanggalBelanja"
                              required
                            />
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="lokasiBelanja">Lokasi Kegiatan</label>
                        <input
                          type="text"
                          class="form-control"
                          id="lokasiBelanja"
                          placeholder="Contoh: Dusun Pacing Wetan"
                        />
                      </div>

                      <div class="form-group">
                        <label for="keteranganBelanja"
                          >Keterangan Tambahan</label
                        >
                        <textarea
                          class="form-control"
                          id="keteranganBelanja"
                          rows="3"
                        ></textarea>
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
                    <form id="formPembiayaan">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tahunPembiayaan">Tahun Anggaran</label>
                            <input
                              type="number"
                              class="form-control"
                              id="tahunPembiayaan"
                              value="2024"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="jenisPembiayaan"
                              >Jenis Pembiayaan</label
                            >
                            <select
                              class="form-control"
                              id="jenisPembiayaan"
                              required
                            >
                              <option value="">Pilih Jenis</option>
                              <option value="penerimaan">
                                Penerimaan Pembiayaan
                              </option>
                              <option value="pengeluaran">
                                Pengeluaran Pembiayaan
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="sumberPembiayaan">Sumber Dana</label>
                        <input
                          type="text"
                          class="form-control"
                          id="sumberPembiayaan"
                          placeholder="Contoh: Sisa Anggaran Tahun Lalu"
                          required
                        />
                      </div>

                      <div class="form-group">
                        <label for="uraianPembiayaan">Uraian Pembiayaan</label>
                        <textarea
                          class="form-control"
                          id="uraianPembiayaan"
                          rows="2"
                          required
                        ></textarea>
                      </div>

                      <div class="row">
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
                                placeholder="0"
                                required
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tanggalPembiayaan"
                              >Tanggal Transaksi</label
                            >
                            <input
                              type="date"
                              class="form-control"
                              id="tanggalPembiayaan"
                              required
                            />
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="keteranganPembiayaan"
                          >Keterangan Tambahan</label
                        >
                        <textarea
                          class="form-control"
                          id="keteranganPembiayaan"
                          rows="3"
                        ></textarea>
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
    <!-- Pastikan urutan pemanggilan script ini tepat -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
      $(document).ready(function () {
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

        // Submit form pendapatan
        $("#formPendapatan").submit(function (e) {
          e.preventDefault();
          alert("Data pendapatan berhasil disimpan!");
          // Di sini bisa ditambahkan AJAX untuk menyimpan data ke server
        });

        // Submit form belanja
        $("#formBelanja").submit(function (e) {
          e.preventDefault();
          alert("Data belanja berhasil disimpan!");
          // Di sini bisa ditambahkan AJAX untuk menyimpan data ke server
        });

        // Submit form pembiayaan
        $("#formPembiayaan").submit(function (e) {
          e.preventDefault();
          alert("Data pembiayaan berhasil disimpan!");
          // Di sini bisa ditambahkan AJAX untuk menyimpan data ke server
        });

        // Tombol reset
        $('button[type="button"]').click(function () {
          $(this).closest("form")[0].reset();
        });
      });
    </script>
  </body>
</html>
