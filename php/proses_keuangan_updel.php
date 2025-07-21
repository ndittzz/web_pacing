<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("Location: ../admin/login.php?pesan=belum_login");
    exit();
}

$action = $_GET['action'] ?? '';
$tipe = $_GET['tipe'] ?? '';
$id = $_GET['id'] ?? 0;

// Ambil tahun anggaran ID berdasarkan tahun
$tahun = date('Y'); // Default tahun sekarang
if (isset($_GET['tahun'])) {
    $tahun = $_GET['tahun'];
}

// Cari ID tahun anggaran
$query = $konek->prepare("SELECT id FROM tahun_anggaran WHERE tahun = ?");
$query->bind_param("s", $tahun);
$query->execute();
$result = $query->get_result();
$tahun_anggaran = $result->fetch_assoc();
$tahun_anggaran_id = $tahun_anggaran['id'] ?? 0;

switch ($action) {
    case 'update':
        // Proses update data
        $id = $_POST['id'];
        $tipe = $_POST['tipe'];
        $jumlah = str_replace(['Rp', '.', ' '], '', $_POST['jumlah']);
        
        if ($tipe === 'pendapatan') {
            $kategori = $_POST['kategori'];
            $stmt = $konek->prepare("UPDATE pendapatan_desa SET kategori=?, jumlah=? WHERE id=?");
            $stmt->bind_param("sii", $kategori, $jumlah, $id);
        } 
        elseif ($tipe === 'belanja') {
            $bidang = $_POST['bidang'];
            $sub_bidang = $_POST['sub_bidang'];
            $stmt = $konek->prepare("UPDATE belanja_desa SET bidang=?, sub_bidang=?, jumlah=? WHERE id=?");
            $stmt->bind_param("ssii", $bidang, $sub_bidang, $jumlah, $id);
        } 
        elseif ($tipe === 'pembiayaan') {
            $jenis = $_POST['jenis'];
            $stmt = $konek->prepare("UPDATE pembiayaan_desa SET jenis=?, jumlah=? WHERE id=?");
            $stmt->bind_param("sii", $jenis, $jumlah, $id);
        }
        
        if ($stmt->execute()) {
            header("Location: ../admin/keuangan.php?tahun=$tahun&pesan=update_sukses");
        } else {
            header("Location: ../admin/keuangan.php?tahun=$tahun&pesan=update_gagal");
        }
        exit();
        
    case 'delete':
        // Proses delete data
        if ($tipe === 'pendapatan') {
            $stmt = $konek->prepare("DELETE FROM pendapatan_desa WHERE id=?");
        } 
        elseif ($tipe === 'belanja') {
            $stmt = $konek->prepare("DELETE FROM belanja_desa WHERE id=?");
        } 
        elseif ($tipe === 'pembiayaan') {
            $stmt = $konek->prepare("DELETE FROM pembiayaan_desa WHERE id=?");
        }
        
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            header("Location: ../admin/keuangan.php?tahun=$tahun&pesan=delete_sukses");
        } else {
            header("Location: ../admin/keuangan.php?tahun=$tahun&pesan=delete_gagal");
        }
        exit();
        
    default:
        header("Location: ../admin/keuangan.php?tahun=$tahun");
        exit();
}
?>