// Fungsi untuk memuat daftar tahun
function muatDaftarTahun() {
  const selectTahun = $("#selectTahun");
  selectTahun.empty();

  // Urutkan tahun dari yang terbaru
  const tahunTerurut = Object.keys(dataKeuangan).sort((a, b) => b - a);

  tahunTerurut.forEach((tahun) => {
    selectTahun.append(`<option value="${tahun}">${tahun}</option>`);
  });

  // Pilih tahun aktif
  selectTahun.val(tahunAktif);
}

// Fungsi untuk menambah tahun baru
function tambahTahunBaru(tahunBaru) {
  if (!tahunBaru || tahunBaru < 2000 || tahunBaru > 2100) {
    Swal.fire("Error", "Tahun harus antara 2000-2100", "error");
    return false;
  }

  if (dataKeuangan[tahunBaru]) {
    Swal.fire("Error", "Tahun ini sudah ada", "error");
    return false;
  }

  // Buat struktur data baru
  dataKeuangan[tahunBaru] = {
    pendapatan: [],
    belanja: [],
    pembiayaan: [],
  };

  // Perbarui daftar tahun
  muatDaftarTahun();

  // Pilih tahun baru
  $("#selectTahun").val(tahunBaru);

  return true;
}

// Event handler
$(document).ready(function () {
  // Muat daftar tahun saat pertama kali load
  muatDaftarTahun();

  // Tombol tambah tahun
  $("#btnTambahTahun").click(function () {
    $("#formTahunBaru").show();
    $("#inputTahunBaru").focus();
  });

  // Simpan tahun baru
  $("#btnSimpanTahunBaru").click(function () {
    const tahunBaru = $("#inputTahunBaru").val();
    if (tambahTahunBaru(tahunBaru)) {
      $("#formTahunBaru").hide();
      $("#inputTahunBaru").val("");
      Swal.fire("Sukses", `Tahun ${tahunBaru} berhasil ditambahkan`, "success");
    }
  });

  // Ganti tahun
  $("#btnGantiTahunSubmit").click(function () {
    const tahunDipilih = $("#selectTahun").val();
    tahunAktif = tahunDipilih;
    tampilkanDataBerdasarkanTahun(tahunAktif);
    $("#tahunModal").modal("hide");
  });
});

function tampilkanDataBerdasarkanTahun(tahun) {
  // Jika tahun tidak ada, buat yang baru
  if (!dataKeuangan[tahun]) {
    dataKeuangan[tahun] = {
      pendapatan: [],
      belanja: [],
      pembiayaan: [],
    };
  }

  // Update judul
  $(".card-title").text(`APBDes Tahun Anggaran ${tahun}`);

  // Hitung total untuk masing-masing jenis
  const totalPendapatan = hitungTotal("pendapatan", tahun);
  const totalBelanja = hitungTotal("belanja", tahun);
  const totalPembiayaan = hitungTotal("pembiayaan", tahun);

  // Tampilkan data pendapatan
  const tabelPendapatan = $("#tabelPendapatan tbody");
  tabelPendapatan.empty();

  dataKeuangan[tahun].pendapatan.forEach((item, index) => {
    const persentase =
      totalPendapatan > 0
        ? Math.round((item.jumlah / totalPendapatan) * 100)
        : 0;

    tabelPendapatan.append(`
      <tr>
        <td>${index + 1}</td>
        <td>${item.uraian}</td>
        <td>${formatRupiah(item.jumlah)}</td>
        <td>
          <div class="progress progress-xs">
            <div class="progress-bar bg-success" style="width: ${persentase}%"></div>
          </div>
          <span class="badge bg-success">${persentase}%</span>
        </td>
        <td>
          <button class="btn btn-sm btn-warning btn-edit" data-id="${
            item.id
          }" data-jenis="pendapatan">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-sm btn-danger btn-hapus" data-id="${
            item.id
          }" data-jenis="pendapatan">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    `);
  });

  // Update footer pendapatan
  $("#footerTotalPendapatan").text(formatRupiah(totalPendapatan));

  // Lakukan hal yang sama untuk belanja dan pembiayaan
  // ...
}

function hitungTotal(jenis, tahun) {
  return dataKeuangan[tahun][jenis].reduce((sum, item) => sum + item.jumlah, 0);
}

// Fungsi untuk mengecek dan membuat tahun depan
function initTahunDepan() {
  const tahunDepan = (new Date().getFullYear() + 1).toString();

  if (!dataKeuangan[tahunDepan]) {
    tambahTahunBaru(tahunDepan);
    Swal.fire({
      title: "Tahun Baru",
      text: `Tahun ${tahunDepan} telah ditambahkan sebagai persiapan`,
      icon: "info",
      confirmButtonText: "OK",
    });
  }
}

// Panggil saat inisialisasi
$(document).ready(function () {
  initTahunDepan();
  muatDaftarTahun();
  tampilkanDataBerdasarkanTahun(tahunAktif);
});
