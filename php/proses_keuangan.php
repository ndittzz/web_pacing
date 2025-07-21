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
    return (float) str_replace(['.', ','], '', $string);
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

        case 'update':
            $id = cleanInput($_POST['id']);
            $tipe = cleanInput($_POST['tipe']);
            $jumlah = convertToNumber(cleanInput($_POST['jumlah']));

            if ($tipe === 'pendapatan') {
                $kategori = cleanInput($_POST['kategori']);
                $stmt = $konek->prepare("UPDATE pendapatan_desa SET kategori = ?, jumlah = ? WHERE id = ?");
                $stmt->bind_param("sdi", $kategori, $jumlah, $id);
            } 
            elseif ($tipe === 'belanja') {
                $bidang = cleanInput($_POST['bidang']);
                $sub_bidang = cleanInput($_POST['sub_bidang']);
                $stmt = $konek->prepare("UPDATE belanja_desa SET bidang = ?, sub_bidang = ?, jumlah = ? WHERE id = ?");
                $stmt->bind_param("ssdi", $bidang, $sub_bidang, $jumlah, $id);
            } 
            elseif ($tipe === 'pembiayaan') {
                $jenis = cleanInput($_POST['jenis']);
                $stmt = $konek->prepare("UPDATE pembiayaan_desa SET jenis = ?, jumlah = ? WHERE id = ?");
                $stmt->bind_param("sdi", $jenis, $jumlah, $id);
            }

            $stmt->execute();
            $stmt->close();
            $_SESSION['success'] = "Data berhasil diperbarui!";
            break;

        case 'delete':
            $tipe = cleanInput($_GET['tipe']);
            $id = cleanInput($_GET['id']);

            if ($tipe === 'pendapatan') {
                $stmt = $konek->prepare("DELETE FROM pendapatan_desa WHERE id = ?");
            } 
            elseif ($tipe === 'belanja') {
                $stmt = $konek->prepare("DELETE FROM belanja_desa WHERE id = ?");
            } 
            elseif ($tipe === 'pembiayaan') {
                $stmt = $konek->prepare("DELETE FROM pembiayaan_desa WHERE id = ?");
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['success'] = "Data berhasil dihapus!";
            break;

        default:
            $_SESSION['error'] = "Aksi tidak valid!";
    }

    header("Location: ../admin/keuangan.php");
    exit();

} catch (Exception $e) {
    $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
    header("Location: ../admin/keuangan.php");
    exit();
}
?>