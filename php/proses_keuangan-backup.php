<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}

$action = $_GET['action'] ?? '';

// Fungsi untuk membersihkan input
function cleanInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Fungsi untuk mengkonversi format angka
function convertToNumber($string) {
    return (float) str_replace('.', '', $string);
}

try {
    switch ($action) {
        case 'pendapatan':
            $tahun = cleanInput($_POST['tahunPendapatan']);
            $kategori = cleanInput($_POST['kategoriPendapatan']);
            $jumlah = convertToNumber(cleanInput($_POST['jumlahPendapatan']));

            // Simpan tahun anggaran jika belum ada
            $stmt = $konek->prepare("INSERT INTO tahun_anggaran (tahun) VALUES (?) ON DUPLICATE KEY UPDATE id=id");
            $stmt->bind_param("s", $tahun);
            $stmt->execute();
            $stmt->close();

            // Dapatkan ID tahun anggaran
            $stmt = $konek->prepare("SELECT id FROM tahun_anggaran WHERE tahun = ?");
            $stmt->bind_param("s", $tahun);
            $stmt->execute();
            $result = $stmt->get_result();
            $tahunAnggaran = $result->fetch_assoc();
            $stmt->close();
            $tahunAnggaranId = $tahunAnggaran['id'];

            // Simpan data pendapatan
            $stmt = $konek->prepare("INSERT INTO pendapatan_desa (tahun_anggaran_id, kategori, jumlah) VALUES (?, ?, ?)");
            $stmt->bind_param("isd", $tahunAnggaranId, $kategori, $jumlah);
            $stmt->execute();
            $stmt->close();

            $_SESSION['success'] = "Data pendapatan berhasil disimpan!";
            break;

        case 'belanja':
            $tahun = cleanInput($_POST['tahunPendapatan']);
            $bidang = cleanInput($_POST['bidangBelanja']);
            $subBidang = cleanInput($_POST['subBidangBelanja']);
            $jumlah = convertToNumber(cleanInput($_POST['jumlahBelanja']));

            // Dapatkan ID tahun anggaran
            $stmt = $konek->prepare("SELECT id FROM tahun_anggaran WHERE tahun = ?");
            $stmt->bind_param("s", $tahun);
            $stmt->execute();
            $result = $stmt->get_result();
            $tahunAnggaran = $result->fetch_assoc();
            $stmt->close();
            $tahunAnggaranId = $tahunAnggaran['id'];

            // Simpan data belanja
            $stmt = $konek->prepare("INSERT INTO belanja_desa (tahun_anggaran_id, bidang, sub_bidang, jumlah) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issd", $tahunAnggaranId, $bidang, $subBidang, $jumlah);
            $stmt->execute();
            $stmt->close();

            $_SESSION['success'] = "Data belanja berhasil disimpan!";
            break;

        case 'pembiayaan':
            $tahun = cleanInput($_POST['tahunPendapatan']);
            $jenis = cleanInput($_POST['jenisPembiayaan']);
            $jumlah = convertToNumber(cleanInput($_POST['jumlahPembiayaan']));

            // Dapatkan ID tahun anggaran
            $stmt = $konek->prepare("SELECT id FROM tahun_anggaran WHERE tahun = ?");
            $stmt->bind_param("s", $tahun);
            $stmt->execute();
            $result = $stmt->get_result();
            $tahunAnggaran = $result->fetch_assoc();
            $stmt->close();
            $tahunAnggaranId = $tahunAnggaran['id'];

            // Simpan data pembiayaan
            $stmt = $konek->prepare("INSERT INTO pembiayaan_desa (tahun_anggaran_id, jenis, jumlah) VALUES (?, ?, ?)");
            $stmt->bind_param("isd", $tahunAnggaranId, $jenis, $jumlah);
            $stmt->execute();
            $stmt->close();

            $_SESSION['success'] = "Data pembiayaan berhasil disimpan!";
            break;

        default:
            $_SESSION['error'] = "Aksi tidak valid!";
    }

    echo json_encode(['status' => 'success']);
    // Redirect tidak perlu jika pakai AJAX
    // header("Location: ../admin/keuangan.php");
    exit();

} catch (Exception $e) {
    $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
    header("Location: keuangan.php");
    exit();
}
?>
